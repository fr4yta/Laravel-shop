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

//Products:
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete')->middleware('auth');

//Route only when you're login:
Route::get('/users/list', [UserController::class, 'index'])->middleware('auth');

//Route to delete user in panel:
Route::delete('/users/{user}',[UserController::class, 'destroy'])->middleware('auth');

//Normal route:
Route::get('/hello', [HelloController::class, 'show']);

//Auth routes:
Auth::routes();

//Default route (home):
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


