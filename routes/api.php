<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\PaymentAccountController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Public route
Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('/v1/refresh', [AuthController::class, 'refresh']);
Route::post('/v1/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('v1/')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::apiResource('users', UserController::class)->only('index', 'show', 'destroy');
        Route::get('/roles', [RoleController::class, 'index']);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('payment-account', PaymentAccountController::class);
    });
});
