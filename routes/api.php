<?php

use App\Http\Controllers\CoverPictureController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeDetailsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/movies', [MovieController::class, 'showAll'])->name('movies.showAll');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::post('/movies/new', [MovieController::class, 'create'])->name('movies.create');
Route::patch('/movies/{id}', [MovieController::class, 'edit'])->name('movies.edit');
Route::delete('/movies/{id}', [MovieController::class, 'remove'])->name('movies.remove');

Route::post('/showtime_details/new', [ShowtimeDetailsController::class, 'create'])->name('showtime_details.new');
Route::delete('/showtime_details/{id}', [ShowtimeDetailsController::class, 'remove'])->name('showtime_details.remove');
Route::patch('/showtime_details/{id}', [ShowtimeDetailsController::class, 'edit'])->name('showtime_details.edit');

Route::post('/cover_picture/new', [CoverPictureController::class, 'create'])->name('cover_picture.new');
Route::delete('/cover_picture/{id}', [CoverPictureController::class, 'remove'])->name('cover_picture.remove');
Route::patch('/cover_picture/{id}', [CoverPictureController::class, 'edit'])->name('cover_picture.edit');
