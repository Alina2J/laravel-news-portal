@extends('layouts.main')

@section('content')
    <h1 style="text-align: center; margin-bottom: 30px;">Лента новостей</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
        @foreach($articles as $article)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">

                {{-- Изображение --}}
                <div style="height: 200px; overflow: hidden; background: #f0f0f0;">
                    <a href="{{ route('gallery', ['img' => $article['full_image']]) }}" title="Посмотреть оригинал">
                        <img src="{{ asset('images/' . $article['preview_image']) }}"
                             alt="{{ $article['name'] }}"
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </a>
                </div>

                {{-- Контент карточки --}}
                <div style="padding: 15px; flex: 1; display: flex; flex-direction: column;">
                    <span style="color: #666; font-size: 0.85rem;">{{ $article->date }}</span>
                    <h3 style="margin: 10px 0; color: #1a1a1a;">{{ $article->name }}</h3>
                    <p style="color: #444; font-size: 0.95rem; flex: 1;">
                        {{ $article->shortDesc ?? mb_strimwidth($article->desc, 0, 120, "...") }}
                    </p>

                    <a href="{{ route('gallery', ['img' => $article['full_image']]) }}" style="display: inline-block; margin-top: 15px; color: #ff4500; font-weight: bold; text-decoration: none;">
                        Читать далее →
                    </a>
                </div>

                {{-- БЛОК УПРАВЛЕНИЯ: Виден только авторизованным --}}
                @auth
                    <div style="margin-top: 15px; display: flex; gap: 10px; border-top: 1px solid #eee; padding-top: 10px;">
                        {{-- Кнопка Редактировать --}}
                        <a href="{{ route('articles.edit', $article->id) }}" style="color: #444; text-decoration: none; font-size: 0.8rem; border: 1px solid #ccc; padding: 3px 8px; border-radius: 4px;">⚙ Редактировать</a>

                        {{-- Кнопка Удалить (через форму, так как это DELETE запрос) --}}
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Вы уверены?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: #ff4500; background: none; border: 1px solid #ff4500; cursor: pointer; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">🗑 Удалить</button>
                        </form>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>
    <div style="margin-top: 40px;">
        {{ $articles->links() }}
    </div>
@endsection