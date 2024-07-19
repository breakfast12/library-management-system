<?php

use App\Http\Controllers\Book\BookController;
use Illuminate\Support\Facades\Route;

/**
 * Book - Book API Routes
 * prefix: api/books
 */
Route::get('/', [BookController::class, 'index'])
    ->name('api.books.index');
Route::post('/', [BookController::class, 'store'])
    ->name('api.books.store');
Route::get('/{id}', [BookController::class, 'show'])
    ->name('api.books.show');
Route::put('/{id}', [BookController::class, 'update'])
    ->name('api.books.update');
Route::delete('/{id}', [BookController::class, 'destroy'])
    ->name('api.books.destroy');
