<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;

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

// メッセージ送信フォームを表示するための GET リクエストのルート
Route::get('/messages', [MessageController::class, 'show']);
// メッセージを送信するための POST リクエストのルート（SQS に送信）
Route::post('/messages', [MessageController::class, 'send']);

// メッセージ処理を開始するための POST リクエストのルート
Route::post('/start-processing', 'MessageProcessingController@start');