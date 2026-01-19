<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ambil genre dari TMDB untuk navbar (global)
        $response = Http::get(
            env('TMDB_ENDPOINT', 'https://api.themoviedb.org/3') . '/genre/movie/list',
            [
                'api_key' => env('TMDB_API_KEY'),
                'language' => 'en-US'
            ]
        );

        $genres = $response->json()['genres'] ?? [];

        // Share ke SEMUA view
        View::share('genres', $genres);
    }
}
