<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/orders', [OrderController::class, 'create']);
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);
Route::put('/orders/{id}', [OrderController::class, 'update']);

Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::delete('/cars/{id}', [CarController::class, 'delete']);
Route::post('/cars', [CarController::class, 'create']);
Route::put('/cars/{id}', [CarController::class, 'update']);

