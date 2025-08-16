<?php

use App\Http\Controllers\API\V1\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\API\V1\Admin\ServiceController;
use App\Http\Controllers\API\V1\User\AuthController as UserAuthController;
use App\Http\Controllers\API\V1\User\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('admin/login', [AdminAuthController::class, 'login']);

    Route::post('register', RegisterController::class);
    Route::post('login', [UserAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('logout', [AdminAuthController::class, 'logout']);
            Route::apiResource('services', ServiceController::class)->middleware('admin');
        });

        Route::post('logout', [UserAuthController::class, 'logout']);
    });
});
