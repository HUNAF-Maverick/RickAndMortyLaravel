<?php

use App\Http\Controllers\Episodes\EpisodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::prefix('episodes')->group(function () {
    Route::get('/', [EpisodeController::class, 'index'])->name('indexEpisodes');
    Route::get('/sync', [EpisodeController::class, 'syncEpisodes'])->name('syncEpisodes');
    Route::post('/get_characters', [EpisodeController::class, 'getCharacters'])->name('getCharacters');
});
