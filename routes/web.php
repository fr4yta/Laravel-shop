<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\UserController;
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

//Standard route:
Route::get('/', function () {
    return view('welcome');
});

//Route only when you're login:
Route::get('/users/list', [UserController::class, 'index'])->middleware('auth');

//Normal route:
Route::get('/hello', [HelloController::class, 'show']);

//Auth routes:
Auth::routes();

//Default route (home):
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


