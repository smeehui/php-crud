<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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



Route::prefix("products")->group(function(){
    Route::get('/', [AppController::class, "products"])->name('products');
    Route::get('/{id}', [AppController::class, "productDetails"]);
    Route::post('/', [AppController::class, "addProduct"]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
