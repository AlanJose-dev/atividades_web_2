<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', \App\Http\Controllers\CategoryController::class);

Route::get('/books/create-id-number', [\App\Http\Controllers\BookController::class, 'createWithId'])->name('books.create.id');
Route::post('/books/create-id-number', [\App\Http\Controllers\BookController::class, 'storeWithId'])->name('books.store.id');

Route::get('/books/create-select', [\App\Http\Controllers\BookController::class, 'createWithSelect'])->name('books.create.select');
Route::post('/books/create-select', [\App\Http\Controllers\BookController::class, 'storeWithSelect'])->name('books.store.select');

// Rotas RESTful para index, show, edit, update, delete (tem que ficar depois das rotas /books/create-id-number e /books/create-select)
Route::resource('books', \App\Http\Controllers\BookController::class)->except(['create', 'store']);
