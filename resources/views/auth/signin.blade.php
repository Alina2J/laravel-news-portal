@extends('layouts.main')

@section('content')
    <div style="max-width: 400px; margin: 0 auto;">
        <h1>Регистрация</h1>

        <form action="/signin" method="POST">
            @csrf {{-- защита от подделки запросов --}}

            <div style="margin-bottom: 15px;">
                <label>Имя:</label><br>
                <input type="text" name="name" value="{{ old('name') }}" style="width: 100%;">
                @error('name')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email:</label><br>
                <input type="email" name="email" value="{{ old('email') }}" style="width: 100%;">
                @error('email')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Пароль:</label><br>
                <input type="password" name="password" style="width: 100%;">
                @error('password')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding: 10px 20px; background: #1a1a1a; color: white; border: none; cursor: pointer;">
                Зарегистрироваться
            </button>
        </form>
    </div>
@endsection