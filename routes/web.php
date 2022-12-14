<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Inertia\Inertia;


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

Route::get('/', [SearchController::class, 'index'])->name('/');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::resource('users', UserController::class)->only(['store']);

Route::middleware('auth')->group(function () {
    Route::resource('favourites', Favouritecontroller::class)->except(['update', 'create', 'show', 'edit']);

    Route::get('/ads/myads', [AdController::class, 'myads'])->name('myads');
    Route::resource('ads', AdController::class)->except(['index', 'show']);

    Route::singleton('profile', ProfileController::class); //->creatable()->except(['create']);
    Route::resource('users', UserController::class)->except(['store']);
});

Route::resource('ads', AdController::class)->only(['index', 'show']);
