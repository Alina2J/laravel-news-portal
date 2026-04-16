<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

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
| Защищенные маршруты (Только для авторизованных: middleware 'auth')
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Выход из системы
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Опасные операции с новостями (Создание, Редактирование, Удаление)
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Просмотр новостей доступен всем гостям
Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

/*
|--------------------------------------------------------------------------
| Маршруты Авторизации (Только для гостей: middleware 'guest')
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Регистрация
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Вход
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


