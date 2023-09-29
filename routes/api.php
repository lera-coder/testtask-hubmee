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

Route::controller(AuthController::class)->group(function () {
    Route::get('login');
    Route::post('register');
    Route::get('logout');
    Route::put('refresh');
});

Route::controller(PostController::class)->group(function () {
    Route::get('post', 'index');
    Route::post('post', 'store');
    Route::get('post/{id}', 'show');
    Route::put('post/{id}', 'update');
    Route::delete('post/{id}', 'destroy');
});


