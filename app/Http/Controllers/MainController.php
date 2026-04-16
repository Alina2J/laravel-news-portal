<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Article;

class MainController extends Controller
{
    public function index()
    {
        // Читаем файл из папки public
        $articles = Article::latest()->take(6)->get();

        return view('home', ['articles' => $articles]);
    }

    public function showGallery($img)
    {
        // Передаем имя файла картинки в представление
        return view('gallery', ['full_image' => $img]);
    }
}
