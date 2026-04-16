<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MainController extends Controller
{
    public function index()
    {
        // Читаем файл из папки public
        $json = File::get(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('home', ['articles' => $articles]);
    }

    public function showGallery($img)
    {
        // Передаем имя файла картинки в представление
        return view('gallery', ['full_image' => $img]);
    }
}
