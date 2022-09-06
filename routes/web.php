<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cofecontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\RolesPermissionsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route::get('/', function () {
//     return bcrypt(123456789);
//     return view('welcome');
// });

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){

    Route::prefix('cofe')->group(function(){

        Route::get('/', [cofecontroller::class , 'home'])->name('home');
        Route::get('/about', [cofecontroller::class , 'about'])->name('about');
        Route::get('/products', [cofecontroller::class , 'products'])->name('products');
        Route::get('/store', [cofecontroller::class , 'store'])->name('store');

    });
});




Route::prefix('/')->middleware('guest:admin')->group(function(){
Route::get('{guard}/login',[AuthController::class,'showlogin'])->name('login');
Route::post('{guard}/login',[AuthController::class,'login'])->name('login');
});

Route::prefix('admin')->middleware('auth:admin')->group(function(){
Route::resource('roles',RolesController::class);
Route::resource('permissions',permissionsController::class);
Route::resource('products',ProductController::class);
Route::resource('admin',AdminController::class);
Route::resource('user',UserController::class);
Route::resource('roles.permissions',RolesPermissionsController::class);
Route::resource('user.permissions',UserPermissionController::class);
});

Route::prefix('admin')->middleware('auth:admin,user')->group(function(){

Route::get('/',[AdminController::class,'index'])->name('index');
Route::resource('/categories',CategoryController::class);
Route::get('edit-password',[AuthController::class,'editpassword'])->name('edit-password');
Route::put('update-password',[AuthController::class,'updatepassword']);
Route::get('edit-profile',[AuthController::class,'editprofile'])->name('edit-profile');
Route::get('logout',[AuthController::class,'logout'])->name('logout');


});
