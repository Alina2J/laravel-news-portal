@extends('layouts.main')

@section('content')
<article style="max-width: 800px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 30px;">
        <span style="color: #666;">{{ $article->date }}</span>
        <h1 style="font-size: 2.5rem; margin: 10px 0;">{{ $article->name }}</h1>
    </header>

    <div style="margin-bottom: 30px;">
        <img src="{{ asset('images/' . $article->preview_image) }}" style="width: 100%; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    </div>

    <div style="line-height: 1.8; font-size: 1.1rem; color: #333; margin-bottom: 50px;">
        {!! nl2br(e($article->desc)) !!}
    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 40px 0;">

    {{-- СЕКЦИЯ КОММЕНТАРИЕВ --}}
    <section>
        <h3>Комментарии ({{ $article->comments->where('is_approved', true)->count() }})</h3>
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        @auth
            <form action="{{ route('comments.store', $article->id) }}" method="POST" style="margin-bottom: 30px;">
                @csrf
                <textarea name="text" rows="3" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;" placeholder="Напишите ваш комментарий..."></textarea>
                <button type="submit" style="margin-top: 10px; background: #ff4500; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                    Отправить
                </button>
            </form>
        @else
            <p style="background: #f8f9fa; padding: 15px; border-radius: 6px;">
                Чтобы оставить комментарий, <a href="{{ route('login') }}" style="color: #ff4500;">войдите в систему</a>.
            </p>
        @endauth

        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($article->comments->where('is_approved', true) as $comment)
                <div style="background: #fff; border: 1px solid #eee; padding: 15px; border-radius: 8px; position: relative; margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>{{ $comment->user->name }}</strong>
                        <span style="color: #999; font-size: 0.8rem;">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>

                    <p style="margin: 0; color: #555; padding-right: 30px;">{{ $comment->text }}</p>

                    {{-- Проверка права на удаление --}}
                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                            style="position: absolute; top: 30px; right: 15px;"
                            onsubmit="return confirm('Удалить этот комментарий?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ff4500; cursor: pointer; font-size: 1.2rem;" title="Удалить">
                                &times;
                            </button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
    </section>
</article>
@endsection