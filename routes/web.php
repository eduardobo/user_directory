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

Route::group(['prefix' => 'palindrom'], function() {
    Route::get('', [App\Http\Controllers\PalindromController::class, 'index'])->name('palindrom.index');
});

Route::group(['prefix' => 'factorial'], function() {
    Route::get('', [App\Http\Controllers\FactorialController::class, 'index'])->name('factorial.index');
});

Route::resource('user', App\Http\Controllers\UserController::class)->only(['index', 'create', 'edit']);