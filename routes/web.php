<?php

use App\Http\Controllers\cofecontroller;
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


Route::prefix('cofe')->group(function(){

    Route::get('/', [cofecontroller::class , 'home'])->name('home');
    Route::get('/about', [cofecontroller::class , 'about'])->name('about');
    Route::get('/products', [cofecontroller::class , 'products'])->name('products');
    Route::get('/store', [cofecontroller::class , 'store'])->name('store');







});
