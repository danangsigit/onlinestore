<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Ecommerce\FrontController;
use App\Http\Controllers\Ecommerce\LoginController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\OrderController;

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

Route::get('/', [FrontController::class, 'index'])->name('ecommerce.index');
Route::get('/product', [FrontController::class, 'product'])->name('ecommerce.product');
Route::get('/category/{slug}', [FrontController::class, 'categoryProduct'])->name('ecommerce.category');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('ecommerce.show_product');
Route::post('cart', [CartController::class, 'addToCart'])->name('ecommerce.cart');
Route::get('/cart', [CartController::class, 'listCart'])->name('ecommerce.list_cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('ecommerce.update_cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('ecommerce.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('ecommerce.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('ecommerce.finish_checkout');

Auth::routes();

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::resource('category', CategoryController::class)->except(['create', 'show']);
  Route::resource('product', ProductController::class)->except(['show']);  
  Route::get('/product/bulk', [ProductController::class, 'massUploadForm'])->name('product.bulk');
  Route::post('/product/bulk', [ProductController::class, 'massUpload'])->name('product.saveBulk');
});

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function() {
  Route::get('login', [LoginController::class, 'loginForm'])->name('customer.login');
  Route::post('login', [LoginController::class, 'login'])->name('customer.post_login');
  Route::get('verify/{token}', [FrontController::class, 'verifyCustomerRegistration'])->name('customer.verify');
});

Route::group(['middleware' => 'customer'], function() {
  Route::get('dashboard', [LoginController::class, 'dashboard'])->name('customer.dashboard');
  Route::get('logout', [LoginController::class, 'logout'])->name('customer.logout');
  Route::get('orders', [OrderController::class, 'index'])->name('customer.orders');
  Route::get('orders/{invoice}', [OrderController::class, 'view'])->name('customer.view_order');
  Route::get('payment', [OrderController::class, 'paymentForm'])->name('customer.paymentForm');
  Route::post('payment', [OrderController::class, 'storePayment'])->name('customer.savePayment');
  Route::get('setting', [FrontController::class, 'customerSettingForm'])->name('customer.settingForm');
  Route::post('setting', [FrontController::class, 'customerUpdateProfile'])->name('customer.setting');
});