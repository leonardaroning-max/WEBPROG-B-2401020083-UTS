<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| ROUTE LAMA (TMDB) - JANGAN DIUBAH
|--------------------------------------------------------------------------
*/

Route::get('/', [FilmController::class, 'home'])->name('home');

Route::get('/genre/{genre}', [FilmController::class, 'genre'])
    ->name('genre');

Route::get('/movie/{id}', [FilmController::class, 'detail'])
    ->name('movie.detail');

Route::get('/search', [FilmController::class, 'search'])
    ->name('search');

Route::get('/tvseries', [FilmController::class, 'tvSeries'])
    ->name('tvseries');


/*
|--------------------------------------------------------------------------
| ROUTE BARU (DATABASE CRUD) - TAMBAHAN SAJA
|--------------------------------------------------------------------------
| Tidak mengganggu route lama
| Digunakan untuk Tambah, Edit, Hapus film
*/

Route::get('/films/create', [FilmController::class, 'create'])
    ->name('films.create');

Route::post('/films', [FilmController::class, 'store'])
    ->name('films.store');

Route::get('/films/{film}/edit', [FilmController::class, 'edit'])
    ->name('films.edit');

Route::put('/films/{film}', [FilmController::class, 'update'])
    ->name('films.update');

Route::delete('/films/{film}', [FilmController::class, 'destroy'])
    ->name('films.destroy');

Route::get('/films/{film}/watch', [FilmController::class, 'watch'])
    ->name('films.watch');
