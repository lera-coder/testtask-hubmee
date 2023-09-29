<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::get('post', 'App\Http\Controllers\PostController@index');


Route::middleware('apu:auth')->group(function () {
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');
    Route::put('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('post', 'App\Http\Controllers\PostController@store');
    Route::get('post/{id}', 'App\Http\Controllers\PostController@show');
    Route::put('post/{id}', 'App\Http\Controllers\PostController@update');
    Route::delete('post/{id}', 'App\Http\Controllers\PostController@destroy');
});



