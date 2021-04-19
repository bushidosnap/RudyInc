<?php

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


Auth::routes();

Route::get('/autocomplete', [App\Http\Controllers\AutocompleteController::class, 'index']);
Route::post('/autocomplete/fetch', [App\Http\Controllers\AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');


Route::view('/tailor', 'tailor.tailor-create')->name('tailor-create');
Route::post('/tailor/create', [App\Http\Controllers\TailorController::class, 'createOrder'])->name('tailor.createOrder');

Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//Profile Views
Route::get('/db', [App\Http\Controllers\ProfilesController::class, 'show']); //route for testing joins
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profiles.show');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profiles.update');

//order controller
Route::post('/changeStatus', [App\Http\Controllers\OrderController::class, 'changeStatus'])->name('order.changeStatus');
Route::any('/showProducts', [App\Http\Controllers\OrderController::class, 'showProducts'])->name('order.showProducts');
