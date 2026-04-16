<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // 1. Список всех новостей (с пагинацией)
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    // 2. Форма создания новости
    public function create()
    {
        return view('articles.create');
    }

    // 3. Сохранение новой новости
    public function store(Request $request)
    {
        // 1. Валидация (добавляем проверку на файл)
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|min:5',
            'desc' => 'required',
            'image_file' => 'required|nullable|image|mimes:jpg,jpeg,png|max:2048', // макс 2МБ
        ]);

        $data = $request->all();

        // 2. Обработка загрузки файла
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');

            // Генерируем уникальное имя: время + оригинальное имя
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Перемещаем файл в public/images
            $file->move(public_path('images'), $fileName);

            // Записываем имя файла в колонки БД (для простоты в обе)
            $data['preview_image'] = $fileName;
            $data['full_image'] = $fileName;
        }

        // 3. Создание записи в базе
        Article::create($data);

        return redirect()->route('articles.index');
    }

    // 4. Просмотр одной новости
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // 5. Форма редактирования
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // 6. Обновление новости
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|min:5|max:255',
            'desc' => 'required|min:10',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            $data['preview_image'] = $fileName;
            $data['full_image'] = $fileName;
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Новость обновлена!');
    }

    // 7. Удаление новости
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Новость удалена!');
    }
}
