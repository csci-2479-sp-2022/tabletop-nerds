<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*Route::controller(GameController::class)->group(function(){
    Route::get('/games', 'show');
});
*/

Route::get('/games', [GameController::class, 'show'])
->name('games');

Route::get('/search-results', [SearchResultController::class, 'show'])
->name('results');


require __DIR__.'/auth.php';
