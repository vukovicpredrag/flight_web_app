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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/country/favorite', [App\Http\Controllers\CountryController::class, 'favorite'])->name('country.favorite');

Route::get('/country/favorite', [App\Http\Controllers\CountryController::class, 'favorite'])->name('country.favorite');

Route::post('/country/comments', [App\Http\Controllers\CountryController::class, 'comments'])->name('country.comments');

Route::post('/country/comments/store', [App\Http\Controllers\CountryController::class, 'storeComment'])->name('country.comment.store');

Route::post( '/country/favorite/manage', [App\Http\Controllers\CountryController::class, 'favoriteManage'])->name('country.favorite.manage');

Route::get('/country/details', [App\Http\Controllers\CountryController::class, 'details'])->name('country.details');

Route::get('/country/getDetails', [App\Http\Controllers\CountryController::class, 'getDetails'])->name('country.getDetails');

