<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

// Home page - redirect to books list
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Book routes
Route::resource('books', BookController::class);

// Borrow routes
Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
Route::get('/books/{book}/borrow', [BorrowController::class, 'create'])->name('borrows.create');
Route::post('/books/{book}/borrow', [BorrowController::class, 'store'])->name('borrows.store');
Route::get('/borrows/{borrowRecord}', [BorrowController::class, 'show'])->name('borrows.show');
Route::post('/borrows/{borrowRecord}/return', [BorrowController::class, 'return'])->name('borrows.return');
