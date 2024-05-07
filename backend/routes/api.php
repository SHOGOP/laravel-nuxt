<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/products', 'App\Http\Controllers\ProductController');
Route::apiResource('/category', 'App\Http\Controllers\CategoryController');
Route::apiResource('/subcategory', 'App\Http\Controllers\SubCategoryController');
Route::apiResource('/detail', 'App\Http\Controllers\DetailController');
Route::apiResource('/option', 'App\Http\Controllers\OptionController');

// restore products
Route::post('/products/restore', ProductController::class . '@restore')->name('products.restore');
// pull products
Route::post('/products/pull', ProductController::class . '@pull')->name('products.pull');
