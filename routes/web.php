<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

// Главная страница портала
Route::get('/', [MainController::class, 'index']);

// Маршрут для галереи с параметром имени картинки
Route::get('/gallery/{img}', [MainController::class, 'showGallery'])->name('gallery');

// Показать страницу регистрации (GET)
Route::get('/signin', [AuthController::class, 'create']);

// Принять данные формы регистрации (POST)
Route::post('/signin', [AuthController::class, 'registration']);

// Информация о редакции
Route::get('/about', function () {
    return view('about');
});

// Контакты с передачей массива
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