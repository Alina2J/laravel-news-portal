<?php

use Illuminate\Support\Facades\Route;

// Главная страница портала
Route::get('/', function () {
    return view('home');
});

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