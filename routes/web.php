<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\DislikeController;
use App\Http\Controllers\User\PurchaseController;

use App\Http\Controllers\GenreController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\User\AlbumController as UserAlbumController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\User\ArtistController as UserArtistController;
use App\Http\Controllers\Admin\ArtistController as AdminArtistController;

use App\Http\Controllers\RecordController;
use App\Http\Controllers\User\RecordController as UserRecordController;
use App\Http\Controllers\Admin\RecordController as AdminRecordController;

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\User\PlaylistController as UserPlaylistController;
use App\Http\Controllers\User\PlaylistRecordController;


Auth::routes();

Route::get('/', [IndexController::class, 'index'])->name('index');

// Artist for all users
Route::prefix('artist')->name('artist.')->group(function(){
    Route::get('/', [ArtistController::class, 'index'])->name('index');
    Route::get('/{artist}', [ArtistController::class, 'show'])->name('show');
});
// Artist for registered user
Route::prefix('user/artist')->name('user.artist.')->group(function(){
    Route::get('/', [UserArtistController::class, 'index'])->name('index');
    Route::get('/create', [UserArtistController::class, 'create'])->name('create');
    Route::post('/', [UserArtistController::class, 'store'])->name('store');
    Route::get('/{artist}', [UserArtistController::class, 'show'])->name('show');
    Route::get('/{artist}/edit', [UserArtistController::class, 'edit'])->name('edit');
    Route::put('/{artist}', [UserArtistController::class, 'update'])->name('update');
    Route::delete('/{artist}', [UserArtistController::class, 'destroy'])->name('destroy');
});
// Artist for Administrator
Route::prefix('admin/artist')->name('admin.artist.')->group(function(){
    Route::get('/', [AdminArtistController::class, 'index'])->name('index');
    Route::get('/{artist}/edit', [AdminArtistController::class, 'edit'])->name('edit');
    Route::put('/{artist}', [AdminArtistController::class, 'update'])->name('update');
    Route::delete('/{artist}', [AdminArtistController::class, 'destroy'])->name('destroy');
});

// Record for all users
Route::prefix('record')->name('record.')->group(function(){
    Route::get('/music', [RecordController::class, 'music'])->name('music');
    Route::get('/video', [RecordController::class, 'video'])->name('video');
    Route::get('/{record}', [RecordController::class, 'show'])->name('show');
});
// Record for registered user
Route::prefix('user/record')->name('user.record.')->group(function(){
    Route::get('/', [UserRecordController::class, 'index'])->name('index');
    Route::get('/create', [UserRecordController::class, 'create'])->name('create');
    Route::post('/', [UserRecordController::class, 'store'])->name('store');
    Route::get('/{record}', [UserRecordController::class, 'show'])->name('show');
    Route::get('/{record}/edit', [UserRecordController::class, 'edit'])->name('edit');
    Route::put('/{record}', [UserRecordController::class, 'update'])->name('update');
    Route::delete('/{record}', [UserRecordController::class, 'destroy'])->name('destroy');
});
// Record for Administrator
Route::prefix('admin/record')->name('admin.record.')->group(function(){
    Route::get('/', [AdminRecordController::class, 'index'])->name('index');
    Route::get('/{record}/edit', [AdminRecordController::class, 'edit'])->name('edit');
    Route::put('/{record}', [AdminRecordController::class, 'update'])->name('update');
    Route::delete('/{record}', [AdminRecordController::class, 'destroy'])->name('destroy');
});

// Playlist for registered user
Route::prefix('user/playlist')->name('user.playlist.')->group(function(){
    Route::get('/', [UserPlaylistController::class, 'index'])->name('index');
    Route::get('/create', [UserPlaylistController::class, 'create'])->name('create');
    Route::post('/', [UserPlaylistController::class, 'store'])->name('store');
    Route::get('/{playlist}', [UserPlaylistController::class, 'show'])->name('show');
    Route::get('/{playlist}/edit', [UserPlaylistController::class, 'edit'])->name('edit');
    Route::put('/{playlist}', [UserPlaylistController::class, 'update'])->name('update');
    Route::delete('/{playlist}', [UserPlaylistController::class, 'destroy'])->name('destroy');
});
// Playlist relations with Record
Route::prefix('user/playlist')->name('playlist.record.')->group(function(){
    Route::get('/{playlist}/add/{record}', [PlaylistRecordController::class, 'update'])->name('update');
    Route::get('/{playlist}/remove/{record}', [PlaylistRecordController::class, 'destroy'])->name('destroy');
});
// Playlist for all users
Route::prefix('playlist')->name('playlist.')->group(function(){
    Route::get('/', [PlaylistController::class, 'index'])->name('index');
    Route::get('/{playlist}', [PlaylistController::class, 'show'])->name('show');
});

// Profile
Route::prefix('user/profile')->name('user.profile.')->group(function() {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/{user}', [ProfileController::class, 'update'])->name('update');
});

// Like
Route::prefix('user/like')->name('user.like.')->group(function(){
    Route::get('/', [LikeController::class, 'index'])->name('index');
    Route::get('/{record}', [LikeController::class, 'create'])->name('create');
    Route::get('/{like}/unlike', [LikeController::class, 'destroy'])->name('delete');
});

// Dislike
Route::prefix('user/dislike')->name('user.dislike.')->group(function(){
    Route::get('/', [DislikeController::class, 'index'])->name('index');
    Route::get('/{record}', [DislikeController::class, 'create'])->name('create');
    Route::get('/{dislike}/dislike', [DislikeController::class, 'destroy'])->name('delete');
});

// Genre
Route::get('genre/record', [GenreController::class, 'index'])->name('genre.record.index');
Route::get('genre/{genre}', [GenreController::class, 'show'])->name('genre.record.show');
Route::prefix('admin/genre')->name('genre.')->group(function(){
    Route::get('/', [AdminGenreController::class, 'index'])->name('index');
    Route::get('/create', [AdminGenreController::class, 'create'])->name('create');
    Route::get('/{genre}/edit', [AdminGenreController::class, 'edit'])->name('edit');
    Route::post('/', [AdminGenreController::class, 'store'])->name('store');
    Route::put('/{genre}', [AdminGenreController::class, 'update'])->name('update');
    // Route::delete('/{genre}', [AdminGenreController::class, 'destroy'])->name('destroy');
});

// Purchase
Route::prefix('user/purchase')->name('user.purchase.')->group(function(){
    Route::get('/', [PurchaseController::class, 'index'])->name('index');
    Route::get('/buy/{record}', [PurchaseController::class, 'create'])->name('create');
    Route::post('/', [PurchaseController::class, 'store'])->name('store');
    Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('show');
    Route::get('/download/{purchase}', [PurchaseController::class, 'download'])->name('download');
});

// Users Administration
Route::prefix('admin/users')->name('admin.user.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
});

// Album for all users
Route::prefix('album')->name('album.')->group(function(){
    // Route::get('/', [AlbumController::class, 'index'])->name('index');
    Route::get('/{album}', [AlbumController::class, 'show'])->name('show');
});
// Album for registered user
Route::prefix('user/album')->name('user.album.')->group(function(){
    Route::get('/', [UserAlbumController::class, 'index'])->name('index');
    Route::get('/create', [UserAlbumController::class, 'create'])->name('create');
    Route::post('/', [UserAlbumController::class, 'store'])->name('store');
    Route::get('/{album}', [UserAlbumController::class, 'show'])->name('show');
    Route::get('/{album}/edit', [UserAlbumController::class, 'edit'])->name('edit');
    Route::put('/{album}', [UserAlbumController::class, 'update'])->name('update');
    Route::delete('/{album}', [UserAlbumController::class, 'destroy'])->name('destroy');
});
// Album for Administrator
// Route::prefix('admin/artist')->name('admin.artist.')->group(function(){
//     Route::get('/', [AdminArtistController::class, 'index'])->name('index');
//     Route::get('/{artist}/edit', [AdminArtistController::class, 'edit'])->name('edit');
//     Route::put('/{artist}', [AdminArtistController::class, 'update'])->name('update');
//     Route::delete('/{artist}', [AdminArtistController::class, 'destroy'])->name('destroy');
// });
