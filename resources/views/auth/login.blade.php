@extends('layouts.main')

@section('content')
<div style="max-width: 400px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="text-align: center;">Вход</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" style="width:100%; padding:8px 0; border: 1px solid {{ $errors->has('email') ? 'red' : '#ccc' }};">
            @error('email')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Пароль:</label>
            <input type="password" name="password" style="width:100%; padding:8px 0; border: 1px solid {{ $errors->has('password') ? 'red' : '#ccc' }};">
            @error('password')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="width:100%; padding:10px; background:#1a1a1a; color:white; border:none; border-radius:4px; cursor:pointer;">
            Войти
        </button>
    </form>
</div>
@endsection