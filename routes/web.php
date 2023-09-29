<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Artist
Route::prefix('artist')->name('artist.')->middleware('auth')->group(function(){
    Route::get('/', [ArtistController::class ,'index'])->name('index');
    Route::get('/create', [ArtistController::class ,'create'])->name('create');
    Route::post('/', [ArtistController::class ,'store'])->name('store');
    Route::get('/{artist}', [ArtistController::class ,'show'])->name('show');
    Route::delete('/{artist}', [ArtistController::class ,'destroy'])->name('destroy');
    Route::get('/{artist}/edit', [ArtistController::class ,'edit'])->name('edit');
    Route::put('/{artist}', [ArtistController::class ,'update'])->name('update');
});

//Record
Route::prefix('record')->name('record.')->group(function(){
    Route::get('/', [RecordController::class ,'index'])->name('index');
    Route::get('/create', [RecordController::class ,'create'])->name('create');
    Route::post('/', [RecordController::class ,'store'])->name('store');
    Route::get('/{record}/edit', [RecordController::class ,'edit'])->name('edit');
    Route::put('/{record}', [RecordController::class ,'update'])->name('update');
    Route::delete('/{record}', [RecordController::class ,'destroy'])->name('destroy');
});

// Profile
Route::prefix('profile')->name('profile.')->group(function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class ,'edit'])->name('edit');
    Route::put('/{id}', [ProfileController::class ,'update'])->name('update');
});


