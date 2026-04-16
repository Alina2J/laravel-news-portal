@extends('layouts.main')

@section('content')
    <a href="/">← Вернуться к новостям</a>
    <div style="text-align: center; margin-top: 20px;">
        <h1>Просмотр изображения</h1>
        <img src="{{ asset('images/' . $full_image) }}" alt="Full image" style="max-width: 100%; border: 5px solid #333;">
    </div>
@endsection