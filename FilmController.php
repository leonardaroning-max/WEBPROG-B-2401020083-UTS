<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    private $api;
    private $endpoint;
    private $image;

    public function __construct()
    {
        $this->api = env('TMDB_API_KEY');
        $this->endpoint = env('TMDB_ENDPOINT', 'https://api.themoviedb.org/3');
        $this->image = env('TMDB_IMAGE', 'https://image.tmdb.org/t/p/w500');
    }

    private function fetch($url, $params = [])
    {
        $params['api_key'] = $this->api;
        $response = Http::get($this->endpoint . $url, $params);
        return $response->json();
    }

    public function home()
    {
        $data = $this->fetch('/movie/popular', ['language' => 'en-US']);
        $films = $data['results'] ?? [];
        $genres = $this->getGenres();
        return view('home', compact('films', 'genres'))->with('image', $this->image);
    }

    public function genre($genreName)
    {
        $genres = $this->getGenres();
        $genreId = null;

        foreach ($genres as $g) {
            if (strtolower($g['name']) == strtolower($genreName)) {
                $genreId = $g['id'];
                break;
            }
        }

        if (!$genreId) abort(404, 'Genre not found');

        $data = $this->fetch('/discover/movie', [
            'with_genres' => $genreId,
            'language' => 'en-US',
            'sort_by' => 'popularity.desc'
        ]);

        $films = $data['results'] ?? [];

        return view('genre', compact('films', 'genres'))
            ->with(['genreName' => ucfirst($genreName), 'image' => $this->image]);
    }

    public function detail($id)
{
    $movie = $this->fetch("/movie/{$id}", [
        'language' => 'en-US',
        'append_to_response' => 'videos'
    ]);

    if (!$movie) {
        abort(404, 'Movie not found');
    }

    // Filter hanya YouTube Trailer
    $trailers = [];
    if (!empty($movie['videos']['results']) && is_array($movie['videos']['results'])) {
        foreach ($movie['videos']['results'] as $video) {
            if (isset($video['site'], $video['type']) && $video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                $trailers[] = $video;
            }
        }
    }

    // Pastikan view file ada di resources/views/movie_detail.blade.php
    return view('movie', compact('movie', 'trailers',));

}

    public function tvSeries()
    {
        $data = $this->fetch('/tv/popular', ['language' => 'en-US']);
        $series = $data['results'] ?? [];
        $genres = $this->getGenres();

        return view('tvseries', compact('series', 'genres'))
            ->with('image', $this->image);
    }

    private function getGenres()
    {
        $data = $this->fetch('/genre/movie/list', ['language' => 'en-US']);
        return $data['genres'] ?? [];
    }
}
