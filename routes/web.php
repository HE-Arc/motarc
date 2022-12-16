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
    Route::resource('ads', AdController::class)->except(['index', 'show', 'update']);

    // Nécessaire pour la mise à jour d'une annonce
    // Les fichiers ne peuvent pas être mis à jour avec la méthode PUT ou PATCH (multipart limitations)
    // Il faut donc utiliser la méthode POST
    // Plus d'infos :
    // - https://laracasts.com/discuss/channels/inertia/request-null-when-upload-edit-file?page=1&replyId=801052
    // https://inertiajs.com/file-uploads#multipart-limitations
    Route::post('/ads/{ad}/update', [AdController::class, 'update'])->name('ads.update');

    Route::singleton('profile', ProfileController::class); //->creatable()->except(['create']);
    Route::resource('users', UserController::class)->except(['store']);
});

Route::resource('ads', AdController::class)->only(['index', 'show']);

// If no route matches, render the 404 page
Route::fallback(function () {
    return Inertia::render('Error/404');
});
