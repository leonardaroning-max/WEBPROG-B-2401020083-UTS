<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', [FilmController::class, 'home'])->name('home');
Route::get('/genre/{genre}', [FilmController::class, 'genre'])->name('genre');
Route::get('/movie/{id}', [FilmController::class, 'detail'])->name('movie.detail');
Route::get('/search', [FilmController::class, 'search'])->name('search');
Route::get('/tvseries', [FilmController::class, 'tvSeries'])->name('tvseries');
