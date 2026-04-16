<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function registerForm() {
        return view('auth.signin');
    }

    // Сохранение пользователя
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация прошла успешно!');
    }

    // Показать форму входа
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Sanctum: Создаем текстовый токен
            $token = $request->user()->createToken('auth_token')->plainTextToken;

            // Можно сохранить токен в сессию, чтобы потом использовать в JS
            session(['api_token' => $token]);

            return redirect()->intended('/')->with('success', 'Вы вошли! Токен присвоен.');
        }

        return back()->withErrors(['email' => 'Неверные учетные данные']);
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            // 1. Удаляем токены Sanctum из базы
            $request->user()->tokens()->delete();
        }

        // 2. Явно вызываем logout для веб-сессии
        Auth::guard('web')->logout();

        // 3. Инвалидируем сессию и обновляем CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}