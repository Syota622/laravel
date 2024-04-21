<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // auth.register という名前のビューを呼び出す(resources/views/auth/register.blade.php)
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // フォーム送信データを処理するメソッド
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 登録後のリダイレクト先（例: ホーム画面）
        return redirect('/');
    }
}