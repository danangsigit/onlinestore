<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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



Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::resource('category', CategoryController::class)->except(['create', 'show']);
  Route::resource('product', ProductController::class)->except(['show']);  
  Route::get('/product/bulk', [ProductController::class, 'massUploadForm'])->name('product.bulk');
  Route::post('/product/bulk', [ProductController::class, 'massUpload'])->name('product.saveBulk');
});