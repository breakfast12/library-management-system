<?php

use App\Http\Controllers\Author\AuthorController;
use Illuminate\Support\Facades\Route;

/**
 * Author - Author API Routes
 * prefix: api/authors
 */
Route::post('/', [AuthorController::class, 'store'])
    ->name('api.authors.store');
Route::get('/{id}', [AuthorController::class, 'show'])
    ->name('api.authors.show');
Route::put('/{id}', [AuthorController::class, 'update'])
    ->name('api.authors.update');
