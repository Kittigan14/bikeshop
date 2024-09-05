<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product', [ProductControllerApi::class, 'product_list']);
Route::get('/product/{category_id}', [ProductControllerApi::class, 'product_list']);
Route::get('/category', [CategoryControllerApi::class, 'category_list']);
Route::post('/product/search', [ProductControllerApi::class, 'product_search']);