<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

//Standard route (default route):
Route::get('/', [WelcomeController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function() {
    Route::middleware(['can:isAdmin'])->group(function() {
        Route::get('products/{product}/download', [ProductController::class, 'downloadImage'])->name('products.downloadImage');

        //Products all:
        Route::resource('products', ProductController::class);

        //Users all:
        Route::resource('users', UserController::class)->only([
            'index', 'edit', 'update', 'destroy'
        ]);
    });

    //Cart:
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{product}',[\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    //Orders:
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');

    //Default route (home):
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

//Normal route:
Route::get('/hello', [HelloController::class, 'show']);

//Auth routes:
Auth::routes(['verify' => true]);

//Przelewy24:
Route::post('/payment/status', [\App\Http\Controllers\PaymentController::class, 'status']);


