<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Показать форму
    public function create()
    {
        return view('auth.signin');
    }

    // Обработать данные формы
    public function registration(Request $request)
    {
        // 1. Валидация
        $request->validate([
            'name'     => 'required|string|min:2|max:50',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Сбор данных в массив
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        // 3. Ответ в формате JSON
        return response()->json($userData);
    }
}