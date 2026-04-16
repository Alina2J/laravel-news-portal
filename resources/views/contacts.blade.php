@extends('layouts.main')

@section('content')
    <h1>Связаться с редакцией</h1>
    <p>Если у вас есть инфоповод или вопрос, напишите нам:</p>
    <div style="background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 5px;">
        <ul style="list-style: none; padding: 0;">
            @foreach($data as $key => $value)
                <li style="margin-bottom: 10px;">
                    <strong>{{ $key }}:</strong> {{ $value }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection