<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/upload', [App\Http\Controllers\UploadController::class, 'index'])->name('upload');


// upload music function
use App\Http\Controllers\MusicUploadController;
Route::post('/upload-song', [MusicUploadController::class, 'uploadSong']);
Route::post('/upload-song-validation', [MusicUploadController::class, 'uploadSongValidation']);
Route::post('/upload-progress', [MusicUploadController::class,'getUploadProgress']);


// upload thumbnail
use App\Http\Controllers\MusicThumbnailController;
Route::post('/upload-song-thumbnail', [MusicThumbnailController::class, 'uploadThumbnail']);




