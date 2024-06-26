<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::prefix('/quote')->group(function () {
        Route::get('/', [QuoteController::class, 'index'])->middleware('auth:sanctum');
    });

    Route::prefix('transaction')->group(function () {
        Route::post('/', [TransactionController::class, 'create'])->middleware('auth:sanctum');
        Route::post('/get', [TransactionController::class, 'getAll'])->middleware('auth:sanctum');
    });
});
