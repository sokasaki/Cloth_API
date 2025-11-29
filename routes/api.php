<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SizeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('/products/{id}', [ProductController::class, 'update']);

Route::apiResource('colors', ColorController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::apiResource('sizes', SizeController::class)->only(['index', 'show', 'store', 'update', 'destroy']);