<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

// 既存のルート
Route::get('/', function () {
    return view('welcome');
});

// 登録フォームを表示するための GET リクエストのルート
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');

// フォームデータを処理するための POST リクエストのルート
Route::post('/register', [RegisterController::class, 'register'])->name('register');

