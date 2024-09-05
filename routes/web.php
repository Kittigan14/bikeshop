<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/product', [ProductController::class , 'index' ]);
Route::get('/product/search', [ProductController::class , 'search' ]);
Route::post('/product/search', [ProductController::class , 'search' ]);
Route::get('/product/edit/{id?}', [ProductController::class , 'edit' ]);
Route::post('/product/update', [ProductController::class , 'update' ]);
Route::post('/product/insert', [ProductController::class , 'insert' ]);
Route::get('/product/remove/{id}', [ProductController::class , 'remove' ]);


Route::get('/category', [CategoryController::class , 'index' ]);
Route::get('/category/search', [CategoryController::class , 'search' ]);
Route::post('/category/search', [CategoryController::class , 'search' ]);
Route::get('/category/edit/{id?}', [CategoryController::class , 'edit' ]);
Route::post('/category/update', [CategoryController::class , 'update' ]);
Route::post('/category/insert', [CategoryController::class , 'insert' ]);
Route::get('/category/remove/{id}', [CategoryController::class , 'remove' ]);

Route::get('/home', [HomeController::class, 'index'])->name('home');