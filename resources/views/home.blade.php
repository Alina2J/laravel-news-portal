@extends('layouts.main')

@section('content')
    <h1>Свежие новости</h1>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        @foreach($articles as $article)
            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                <p><small>{{ $article['date'] }}</small></p>
                <h3>{{ $article['name'] }}</h3>

                {{-- Ссылка-картинка на галерею --}}
                <a href="{{ route('gallery', ['img' => $article['full_image']]) }}">
                    {{-- Добавляем /images/ перед именем файла --}}
                    <img src="{{ asset('images/' . $article['preview_image']) }}" alt="preview" style="width: 100%; max-width: 200px;">
                </a>

                <p>{{ $article['shortDesc'] ?? mb_strimwidth($article['desc'], 0, 100, "...") }}</p>
            </div>
        @endforeach
    </div>
@endsection