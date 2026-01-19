<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Film;

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

    /* =======================
       BAGIAN API TMDB (LAMA)
       ======================= */

    private function fetch($url, $params = [])
    {
        $params['api_key'] = $this->api;
        $response = Http::get($this->endpoint . $url, $params);
        return $response->json();
    }

    public function home()
   {
    // Film dari TMDB
    $data = $this->fetch('/movie/popular', ['language' => 'en-US']);
    $tmdbFilms = $data['results'] ?? [];

    // Film dari Database
    $dbFilms = Film::latest()->get();

    $genres = $this->getGenres();

    return view('home', compact('tmdbFilms', 'dbFilms', 'genres'))
        ->with('image', $this->image);
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
            ->with([
                'genreName' => ucfirst($genreName),
                'image' => $this->image
            ]);
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

        $trailers = [];
        if (!empty($movie['videos']['results'])) {
            foreach ($movie['videos']['results'] as $video) {
                if (
                    isset($video['site'], $video['type']) &&
                    $video['site'] === 'YouTube' &&
                    $video['type'] === 'Trailer'
                ) {
                    $trailers[] = $video;
                }
            }
        }

        return view('movie', compact('movie', 'trailers'));
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

    /* =========================
       BAGIAN DATABASE (BARU)
       ========================= */

    // Form tambah film (database)
    public function create()
    {
        return view('films.create');
    }

    // Simpan film ke MySQL
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'poster' => 'required|url',
        'rating' => 'required|numeric',
        'trailer' => 'nullable|url',
    ]);

    Film::create($request->all());

    return redirect()->route('home')->with('success', 'Film berhasil ditambahkan');
}


    // Form edit film
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    // Update film
    public function update(Request $request, Film $film)
{
    $request->validate([
        'title' => 'required',
        'poster' => 'required|url',
        'rating' => 'required|numeric',
        'trailer' => 'nullable|url',
    ]);

    $film->update($request->all());

    return redirect()->route('home')->with('success', 'Film berhasil diupdate');
}

//nonton trailer
public function watch(Film $film)
{
    return view('films.watch', compact('film'));
}


    // Hapus film
    public function destroy(Film $film)
    {
        $film->delete();

        return redirect('/')
            ->with('success', 'Film berhasil dihapus');
    }
}
