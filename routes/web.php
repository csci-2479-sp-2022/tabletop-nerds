<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\SearchResultController;
use App\Http\Controllers\WishlistController;
use App\Services\AccountService;
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

Route::get('/info', function () {
    return phpinfo();
})->name('info');


Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

Route::controller(GameController::class)->group(function() {
    Route::get('/games', 'showGameList')->name('games');
    Route::get('/game/{id}', 'showGame')->whereNumber('id')->name('game-info');
    Route::get('/games/add-game', 'addGameForm')->middleware('auth')->name('add-game-form');
    Route::post('/games/add-game', 'addGame')->middleware('auth')->name('add-game');
    Route::get('/games/add-publisher', 'addPublisherForm')->middleware('auth')->name('add-publisher-form');
    Route::post('/games/add-publisher', 'addPublisher')->middleware('auth')->name('add-publisher');
    Route::get('/games/add-category', 'addCategoryForm')->middleware('auth')->name('add-category-form');
    Route::post('/games/add-category', 'addCategory')->middleware('auth')->name('add-category');
});

Route::controller(ReviewController::class)->group(function(){
    Route::get('/game/{id}/review', 'show')->whereNumber('id')->middleware('auth')->name('review');
    Route::post('/game/{id}/review', 'create')->whereNumber('id')->middleware('auth')->name('review-create');
    Route::delete('/game/{id}/review', 'delete')->whereNumber('id')->middleware('auth')->name('review-delete');
});


Route::post('/like-unlike-game', [WishlistController::class, 'updateWishlist'])
->name('like-unlike-game');

Route::get('/search-results', [SearchResultController::class, 'show'])
->name('results');

Route::controller(AccountController::class)->group(function() {
    Route::get('/wishlist', 'show')->name('wishlist');
});

Route::post('/rate-unrate-game', [RatingsController::class, 'updateRating'])
->name('rate-unrate-game');

require __DIR__.'/auth.php';
