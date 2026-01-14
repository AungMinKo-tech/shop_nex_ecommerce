<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\PaymentAccountController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Client\CartController;
use Illuminate\Support\Facades\Route;

// Role 1 = admin | Role 2 = staff | Role 3 = user

Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('/v1/refresh', [AuthController::class, 'refresh']);
Route::post('/v1/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('v1/')->group(function () {
    Route::middleware(['auth:sanctum', 'Role.check:1'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index']);
        Route::apiResource('payment-accounts', PaymentAccountController::class);
    });

    Route::middleware(['auth:sanctum', 'Role.check:1,2'])->group(function () {
        Route::apiResource('users', UserController::class)->only('index', 'show', 'destroy');
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
    });

    Route::middleware(['auth:sanctum', 'Role.check:3'])->group(function () {
        Route::apiResource('carts', CartController::class);
    });
});
