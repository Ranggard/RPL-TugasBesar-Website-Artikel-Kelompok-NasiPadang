<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

// --- 1. Public Routes ---
Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// --- 2. Guest Routes ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// --- 3. Auth Routes ---
Route::middleware('auth')->group(function () {
    
    // Rute Statis (Wajib di atas rute {id})
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/my-articles', [ArticleController::class, 'management'])->name('articles.mine');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/management', [ArticleController::class, 'management'])->name('articles.management');
    
    // Rute dengan Parameter {id} (Taruh di bawah)
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::post('/articles/{articleId}/like', [LikeController::class, 'store'])->name('articles.like');
    Route::post('/articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');   
    Route::post('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::post('/articles/{id}/unpublish', [ArticleController::class, 'unpublish'])->name('articles.unpublish');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// --- 4. Public Route Parameter (Paling Bawah) ---
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');