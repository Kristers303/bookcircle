<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', LanguageController::class);


Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
Route::resource('book', BookController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function() {
    Route::resource('book', BookController::class)->except(['index', 'show']);
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');    
    Route::post('/books/{book}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');
    Route::post('/books/{book}/ratings', [RatingController::class, 'store'])->middleware('auth')->name('ratings.store');
    Route::post('/books/{book}/reserve', [BookController::class, 'reserve'])->middleware('auth')->name('book.reserve');

});

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});