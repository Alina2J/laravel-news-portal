<!DOCTYPE html>
<html>
<head>
    <title>Новая статья</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="background: #f4f4f4; padding: 20px; border-radius: 10px;">
        <h2 style="color: #ff4500;">Уважаемый модератор!</h2>
        <p>На сайте была опубликована новая статья: <strong>{{ $article->name }}</strong></p>
        <p><em>Дата публикации: {{ $article->date }}</em></p>
        <hr>
        <p>Вы можете просмотреть её по ссылке:</p>
        <a href="{{ route('articles.show', $article->id) }}"
           style="background: #ff4500; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
           Перейти к статье
        </a>
    </div>
</body>
</html>