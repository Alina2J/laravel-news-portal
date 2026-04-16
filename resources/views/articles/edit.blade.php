@extends('layouts.main')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <h1>Редактировать статью</h1>

        {{-- Маршрут меняется на UPDATE, добавляем ID статьи --}}
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Обязательно для редактирования в Laravel --}}

            <div style="margin-bottom: 15px;">
                <label>Дата:</label><br>
                <input type="date" name="date" value="{{ $article->date }}" style="width: 100%; padding: 8px;">
                @error('date') <div style="color: red; font-size: 12px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Заголовок:</label><br>
                <input type="text" name="name" value="{{ $article->name }}" style="width: 100%; padding: 8px;">
                @error('name') <div style="color: red; font-size: 12px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Текст новости:</label><br>
                <textarea name="desc" rows="10" style="width: 100%; padding: 8px;">{{ $article->desc }}</textarea>
                @error('desc') <div style="color: red; font-size: 12px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Текущее изображение:</label><br>
                <img src="{{ asset('images/' . $article->preview_image) }}" width="100" style="margin-bottom: 10px; border-radius: 4px;"><br>

                <label>Заменить изображение (необязательно):</label><br>
                <input type="file" name="image_file" accept="image/*" style="margin-bottom: 20px;">
                @error('image_file') <div style="color: red; font-size: 12px;">{{ $message }}</div> @enderror
            </div>

            <button type="submit" style="background: #1a1a1a; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">Сохранить изменения</button>
            <a href="{{ route('articles.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Отмена</a>
        </form>
    </div>
@endsection