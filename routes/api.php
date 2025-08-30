<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\OrderController;
use App\Http\Controllers\Api\v1\Admin\UserController;
use App\Http\Controllers\Api\v1\Admin\PaymentController;

Route::prefix('v1/admin')
    ->middleware(['auth:sanctum', 'is_admin'])
    ->name('api.admin.')
    ->group(function () {

        Route::apiResource('products', ProductController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('orders', OrderController::class)->only(['index', 'show', 'update']);
        Route::apiResource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::apiResource('payments', PaymentController::class)->only(['index', 'show', 'update']);
});
