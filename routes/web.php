<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Публичные маршруты (Доступны всем)
|--------------------------------------------------------------------------
*/

Route::get('/', [MainController::class, 'index']);
Route::get('/about', fn() => view('about'));
Route::get('/gallery/{img}', [MainController::class, 'showGallery'])->name('gallery');

// Контакты
Route::get('/contacts', function () {
    $newsContacts = [
        'Редакция' => 'г. Москва, ул. Пресс-центр, д. 5',
        'Горячая линия' => '8 (800) 555-35-35',
        'Email для новостей' => 'news@newsportal.ru',
        'Техподдержка' => 'support@newsportal.ru',
        'Telegram' => '@news_portal_live'
    ];
    return view('contacts', ['data' => $newsContacts]);
});

/*
|--------------------------------------------------------------------------
| Защищенные маршруты (Middleware 'auth:sanctum' + Policies)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Выход из системы
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Добавление комментариев
    Route::post('/articles/{article}/comments', [ArticleController::class, 'storeComment'])->name('comments.store');
    // Удаление комментария с проверкой политики
    Route::delete('/comments/{comment}', [ArticleController::class, 'destroyComment'])
        ->name('comments.destroy')
        ->can('delete', 'comment'); // 'delete' — метод в Policy, 'comment' — имя параметра из пути

    /* Операции для Модератора (Проверка через ArticlePolicy) */

    // Создание
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create')
        ->can('create', Article::class); // Проверка ArticlePolicy@create

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store')
        ->can('create', Article::class);

    // Редактирование и удаление (привязка к конкретному объекту {article})
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit')
        ->can('update', 'article'); // Проверка ArticlePolicy@update

    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update')
        ->can('update', 'article');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy')
        ->can('delete', 'article');
});

/*
|--------------------------------------------------------------------------
| Публичный просмотр новостей
|--------------------------------------------------------------------------
*/
Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

/*
|--------------------------------------------------------------------------
| Маршруты Авторизации (middleware 'guest')
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});