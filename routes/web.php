<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'welcome'])->name('welcome');
Route::post('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
Route::post('/editProduct', [ProductController::class, 'editProduct'])->name('editProduct');
Route::delete('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
