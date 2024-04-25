<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;

// 既存のルート
Route::get('/', function () {
    return view('welcome');
});

// 登録フォームを表示するための GET リクエストのルート
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
// ユーザー登録を処理するための POST リクエストのルート
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// ログインフォームを表示するための GET リクエストのルート
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// ログインを処理するための POST リクエストのルート
Route::post('login', [LoginController::class, 'login']);
// ログアウトを処理するための POST リクエストのルート
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// 投稿するためのフォームを表示するための GET リクエストのルート
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// 投稿を処理するための POST リクエストのルート
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');