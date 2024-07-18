<?php

use App\Http\Controllers\Book\BookController;
use Illuminate\Support\Facades\Route;

/**
 * Book - Book API Routes
 * prefix: api/books
 */
Route::post('/', [BookController::class, 'store'])
    ->name('api.books.store');
