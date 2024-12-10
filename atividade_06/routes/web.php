<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', \App\Http\Controllers\CategoryController::class);

Route::get('/books/create-id-number', [\App\Http\Controllers\BookController::class, 'createWithId'])->name('books.create.id');
Route::post('/books/create-id-number', [\App\Http\Controllers\BookController::class, 'storeWithId'])->name('books.store.id');

Route::get('/books/create-select', [\App\Http\Controllers\BookController::class, 'createWithSelect'])->name('books.create.select');
Route::post('/books/create-select', [\App\Http\Controllers\BookController::class, 'storeWithSelect'])->name('books.store.select');

Route::resource('books', \App\Http\Controllers\BookController::class)->except(['create', 'store']);

Route::resource('users', \App\Http\Controllers\UserController::class)->except(['create', 'store', 'destroy']);

Route::post('/books/{book}/borrow', [\App\Http\Controllers\BorrowingController::class, 'store'])->name('books.borrow');

Route::get('/users/{user}/borrowings', [\App\Http\Controllers\BorrowingController::class, 'userBorrowings'])->name('users.borrowings');

Route::patch('/borrowings/{borrowing}/return', [\App\Http\Controllers\BorrowingController::class, 'returnBook'])->name('borrowings.return');
