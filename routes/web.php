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

Route::get('/getprize', [App\Http\Controllers\PrizeController::class, 'prize'])->name('getprize');

Route::post('/getloyalty', [App\Http\Controllers\PrizeController::class, 'loyalty'])->name('getloyalty');

Route::post('/returnprize', [App\Http\Controllers\PrizeController::class, 'return'])->name('getloyalty');
