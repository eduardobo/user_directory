<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'factorial'], function() {
    Route::post('calulate_factorial', [App\Http\Controllers\FactorialController::class, 'calculateFactorial']);
});

Route::group(['prefix' => 'palindrom'], function() {
    Route::post('check_palindrom', [App\Http\Controllers\PalindromController::class, 'checkPalindrom']);
});

Route::resource('user', App\Http\Controllers\UserController::class)->only(['store', 'update', 'destroy']);