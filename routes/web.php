<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/product', [App\Http\Controllers\ProductController::class , 'index' ]);

Route::get('/product/search', [App\Http\Controllers\ProductController::class , 'search' ]);
Route::post('/product/search', [App\Http\Controllers\ProductController::class , 'search' ]);

Route::get('/product/edit/{id?}', [App\Http\Controllers\ProductController::class , 'edit' ]);
Route::post('/product/update', [App\Http\Controllers\ProductController::class , 'update' ]);

Route::post('/product/insert', [App\Http\Controllers\ProductController::class , 'insert' ]);

Route::get('/product/remove/{id}', [App\Http\Controllers\ProductController::class , 'remove' ]);