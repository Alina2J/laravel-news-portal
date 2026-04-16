<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>NewsPortal — Твои свежие новости</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; display: flex; flex-direction: column; min-height: 100vh; color: #333; }
        header { background: #1a1a1a; color: #fff; padding: 1rem 2rem; }
        nav { display: flex; gap: 20px; }
        nav a { color: #fff; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #ff4500; }
        main { flex: 1; padding: 2rem; max-width: 1200px; margin: 0 auto; width: 100%; }
        footer { background: #f4f4f4; text-align: center; padding: 1.5rem; border-top: 1px solid #ddd; }
        .welcome-card { background: #e9ecef; padding: 2rem; border-radius: 8px; text-align: center; }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/">Главная</a>
            <a href="/news">Новости</a>
            <a href="/about">О нас</a>
            <a href="/contacts">Контакты</a>
            <a href="/signin">Регистрация</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Курсовой проект по Laravel | Выполнила: Лебедева Алина Александровна, группа 243-323</p>
    </footer>
</body>
</html>