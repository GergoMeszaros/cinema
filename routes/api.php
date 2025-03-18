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

Route::get('/movies', [MovieController::class, 'showAll']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::post('/movies/new', [MovieController::class, 'create']);
Route::patch('/movies/{id}', [MovieController::class, 'edit']);
Route::delete('/movies/{id}', [MovieController::class, 'remove']);

Route::delete('/showtime_details/{id}', [ShowtimeDetailsController::class, 'remove']);
Route::patch('/showtime_details/{id}', [ShowtimeDetailsController::class, 'edit']);

Route::delete('/cover_picture/{id}', [CoverPictureController::class, 'remove']);
Route::patch('/cover_picture/{id}', [CoverPictureController::class, 'edit']);


