<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavouriteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    //Route::resource('users', UserController::class)->except(['index, show']);

    Route::resource('favourites', Favouritecontroller::class)->except(['index', 'update', 'create', 'show', 'edit']);

    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites');

    Route::resource('ads', AdController::class)->except(['index', 'show']);
});

//Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('users', UserController::class);

Route::resource('ads', AdController::class)->only(['index', 'show']);
