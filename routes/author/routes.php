<?php

use App\Http\Controllers\Author\AuthorController;
use Illuminate\Support\Facades\Route;

/**
 * Author - Author API Routes
 * prefix: api/authors
 */
Route::get('/', [AuthorController::class, 'index'])
    ->name('api.authors.index');
Route::post('/', [AuthorController::class, 'store'])
    ->name('api.authors.store');
Route::get('/{id}', [AuthorController::class, 'show'])
    ->name('api.authors.show');
Route::get('/{id}/books', [AuthorController::class, 'catalogue'])
    ->name('api.authors.catalogue');
Route::put('/{id}', [AuthorController::class, 'update'])
    ->name('api.authors.update');
Route::delete('/{id}', [AuthorController::class, 'destroy'])
    ->name('api.authors.destroy');
