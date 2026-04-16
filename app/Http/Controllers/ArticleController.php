<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Получаем все статьи из базы данных
        $articles = \App\Models\Article::all();
        return view('articles.index', ['articles' => $articles]);
    }
}
