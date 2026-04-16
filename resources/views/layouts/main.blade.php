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
        /* Стили для пагинации (Bootstrap-совместимые) */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 0; /* Убираем зазоры для классического вида */
            justify-content: center;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: block;
            padding: 8px 16px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #1a1a1a;
            background: #fff;
            transition: all 0.2s;
        }

        /* Скругление краев для первой и последней кнопки */
        .page-item:first-child .page-link {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        /* Активная страница (оранжевая) */
        .page-item.active .page-link {
            background-color: #ff4500;
            border-color: #ff4500;
            color: white;
        }

        /* Эффект при наведении */
        .page-link:hover {
            background-color: #f4f4f4;
        }

        /* Заблокированные кнопки (Назад, когда мы на 1 странице) */
        .page-item.disabled .page-link {
            color: #ccc;
            cursor: not-allowed;
            background-color: #fff;
        }

        /* Скрываем мобильную версию пагинации, если она дублируется */
        .d-sm-none { display: none; }
        .d-sm-flex { display: flex !important; }

        /* Текст "Показано с..." */
        .small.text-muted {
            text-align: center;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/">Главная</a>
            <a href="{{ route('articles.index') }}">Новости</a>
            <a href="/about">О нас</a>
            <a href="/contacts">Контакты</a>
            <a href="/signin">Регистрация</a>
            <a href="{{ route('articles.create') }}" style="color: #ff4500;">+ Добавить статью</a>
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