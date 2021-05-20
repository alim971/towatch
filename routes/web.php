<?php

use App\Http\Controllers\MovieController;
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

Route::resource('/movies', MovieController::class);
Route::get('/', 'App\Http\Controllers\MovieController@index')->name('index');
Route::post('/only', 'App\Http\Controllers\MovieController@only')->name('only');
Route::get('/movies/{movie}/watch', 'App\Http\Controllers\MovieController@watch')->name('movies.watch');
Route::get('/movies/{movie}/up', 'App\Http\Controllers\MovieController@up')->name('movies.up');
Route::get('/movies/{movie}/showing', 'App\Http\Controllers\MovieController@showing')->name('movies.showing');
Route::get('/auto', 'App\Http\Controllers\MovieController@auto')->name('movies.auto');

Auth::routes();
