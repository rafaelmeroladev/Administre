<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LProductController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', ProductsController::class);
Route::resource('lproducts', LProductController::class);
Route::resource('cart', CartController::class);
Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{item}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/confirm', [CartController::class, 'confirmOrder'])->name('cart.confirm');