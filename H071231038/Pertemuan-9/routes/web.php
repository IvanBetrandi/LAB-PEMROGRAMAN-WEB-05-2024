<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryLogController;

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



Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/inventory-logs', [InventoryLogController::class, 'index'])->name('inventory-logs.index');


Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('inventory-logs', InventoryLogController::class);

