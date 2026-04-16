@extends('layouts.main')

@section('content')
<style>
    .moderation-container {
        margin-top: 30px;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .moderation-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .moderation-table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        padding: 12px;
        text-align: left;
        border-bottom: 2px solid #dee2e6;
    }

    .moderation-table td {
        padding: 15px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
    }

    .moderation-table tr:hover {
        background-color: #fcfcfc;
    }

    .user-name {
        font-weight: bold;
        color: #007bff;
    }

    .comment-text {
        color: #555;
        max-width: 400px;
        word-wrap: break-word;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-success { background-color: #28a745; color: white; }
    .btn-success:hover { background-color: #218838; }

    .btn-danger { background-color: #dc3545; color: white; }
    .btn-danger:hover { background-color: #c82333; }

    .empty-msg {
        text-align: center;
        padding: 40px;
        color: #888;
        font-style: italic;
    }
</style>

<div class="moderation-container">
    <h2>Комментарии на модерации</h2>

    <table class="moderation-table">
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>Текст комментария</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr>
                <td class="user-name">{{ $comment->user->name }}</td>
                <td class="comment-text">{{ $comment->text }}</td>
                <td class="actions">
                    <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Одобрить</button>
                    </form>

                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-msg">Новых комментариев для проверки нет.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection