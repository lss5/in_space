<?php

use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [IndexController::class, 'index'])->name('index');

// Artist
Route::prefix('artist')->name('artist.')->group(function(){
    Route::get('/', [ArtistController::class ,'index'])->name('index');
    Route::get('/create', [ArtistController::class ,'create'])->name('create');
    Route::get('/{artist}', [ArtistController::class ,'show'])->name('show');
    Route::post('/', [ArtistController::class ,'store'])->name('store');
    Route::get('/{artist}/edit', [ArtistController::class ,'edit'])->name('edit');
    Route::put('/{artist}', [ArtistController::class ,'update'])->name('update');
    Route::delete('/{artist}', [ArtistController::class ,'destroy'])->name('destroy');
});

//Record
Route::prefix('record')->name('record.')->group(function(){
    Route::get('/', [RecordController::class ,'index'])->name('index');
    Route::get('/create', [RecordController::class ,'create'])->name('create');
    Route::post('/', [RecordController::class ,'store'])->name('store');
    Route::get('/{record}', [RecordController::class ,'show'])->name('show');
    Route::get('/{record}/edit', [RecordController::class ,'edit'])->name('edit');
    Route::get('/{record}/to_playlist/{playlist}', [RecordController::class ,'to_playlist'])->name('to_playlist');
    Route::get('/{record}/out_playlist/{playlist}', [RecordController::class ,'out_playlist'])->name('out_playlist');
    Route::put('/{record}', [RecordController::class ,'update'])->name('update');
    Route::delete('/{record}', [RecordController::class ,'destroy'])->name('destroy');
});

//Playlist
Route::prefix('playlist')->name('playlist.')->group(function(){
    Route::get('/', [PlaylistController::class ,'index'])->name('index');
    Route::get('/create', [PlaylistController::class ,'create'])->name('create');
    Route::get('/{playlist}', [PlaylistController::class ,'show'])->name('show');
    Route::get('/{playlist}/edit', [PlaylistController::class ,'edit'])->name('edit');
    Route::post('/', [PlaylistController::class ,'store'])->name('store');
    Route::put('/{playlist}', [PlaylistController::class ,'update'])->name('update');
    Route::delete('/{playlist}', [PlaylistController::class ,'destroy'])->name('destroy');
});

// Profile
Route::prefix('profile')->name('profile.')->group(function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class ,'edit'])->name('edit');
    Route::put('/{user}', [ProfileController::class ,'update'])->name('update');
});

//Like
Route::prefix('like')->name('like.')->group(function(){
    Route::get('/', [LikeController::class ,'index'])->name('index');
    Route::get('/{record}', [LikeController::class ,'create'])->name('create');
    Route::get('/{like}/unlike', [LikeController::class ,'destroy'])->name('delete');
});

//Genre
Route::prefix('genre')->name('genre.')->group(function(){
    Route::get('/', [GenreController::class ,'index'])->name('index');
    Route::get('/create', [GenreController::class ,'create'])->name('create');
    Route::get('/{genre}/edit', [GenreController::class ,'edit'])->name('edit');
    Route::post('/', [GenreController::class ,'store'])->name('store');
    Route::put('/{genre}', [GenreController::class ,'update'])->name('update');
    // Route::delete('/{genre}', [GenreController::class ,'destroy'])->name('destroy');
});


