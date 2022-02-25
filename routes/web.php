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
        //Products all:
        Route::resource('products', ProductController::class);

        //Route only when you're login:
        Route::get('/users/list', [UserController::class, 'index']);

        //Route to delete user in panel:
        Route::delete('/users/{user}',[UserController::class, 'destroy']);
    });

    //Cart:
    Route::get('/cart/list', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

    //Default route (home):
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

//Normal route:
Route::get('/hello', [HelloController::class, 'show']);

//Auth routes:
Auth::routes(['verify' => true]);


