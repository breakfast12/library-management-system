<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Authentication - Login API Routes
 */
Route::prefix('login')->group(function () {
    /**
     * Login API Routes
     * prefix: api/auth/login
     */
    Route::post('/', [AuthController::class, 'login'])
        ->name('api.auth.login');
});

/**
 * Authentication - Logout API Routes
 * prefix: api/auth/logout
 */
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('api.auth.logout')
    ->middleware('auth:api');
