@extends('layouts.main')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <h1>Добавить статью</h1>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Дата:</label><br>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" style="width: 100%; padding: 8px;">
                @error('date')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Заголовок:</label><br>
                <input type="text" name="name" style="width: 100%; padding: 8px;">
                @error('name')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Текст новости:</label><br>
                <textarea name="desc" rows="10" style="width: 100%; padding: 8px;"></textarea>
                @error('desc')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Изображение новости:</label><br>
                <input type="file" name="image_file" accept="image/*" style="margin-bottom: 20px;">
                @error('image_file')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" style="background: #1a1a1a; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">Опубликовать</button>
        </form>
    </div>
@endsection