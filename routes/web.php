<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SearchResultController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('homepage');
})->name('home');


Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');


Route::controller(GameController::class)->group(function() {
    Route::get('/games', 'show')->name('games');
    Route::get('/game/{id}', 'view')->name('game-info');
});

Route::get('/search-results', [SearchResultController::class, 'show'])
->name('results');

Route::post('/search-results', function(){
    return redirect()->route('results');
});

Route::controller(AccountController::class)->group(function() {
    Route::get('/wishlist', 'show')->middleware(['auth'])->name('wishlist');
    Route::get('/wishlist/{id}', 'view')->middleware(['auth'])->name('wish-info');
});

require __DIR__.'/auth.php';
