<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// =================================================================================== USER
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// =================================================================================== PRODUCT
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/top-products', [ProductController::class, 'topProducts']);

// =================================================================================== ORDER
Route::get('/order', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/order', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::post('/konfirmasi', [OrderController::class, 'konfirmasi'])->middleware('auth:sanctum');
Route::get('/history', [OrderController::class, 'history'])->middleware('auth:sanctum');
