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



Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
  Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
  Route::get('/category/{category_id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/category/{category_id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
  Route::delete('/category/{category_id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');
  
});