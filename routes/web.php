<?php

use App\Http\Controllers\{
    HomeController, 
    ProductController, 
    CategoryController
};
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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('product')->group(function () {
    Route::post('store', [ProductController::class, 'store'])->name('product-store');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('product-update');
    Route::post('destroy/{id}', [ProductController::class, 'destroy'])->name('product-destroy');
});

Route::prefix('category')->group(function () {
    Route::post('store', [CategoryController::class, 'store'])->name('category-store');
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('category-update');
    Route::post('destroy/{id}', [CategoryController::class, 'destroy'])->name('category-destroy');
});
