<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ArticleCreatedMail;
use Illuminate\Support\Facades\Mail;

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
        $article = Article::create($data);

        // 4. Находим почту модератора
        $moderator = User::where('role_id', 1)->first();

        if ($moderator) {
            Mail::to($moderator->email)->send(new ArticleCreatedMail($article));
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана и уведомление отправлено!');
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

    public function storeComment(Request $request, Article $article)
    {
        $request->validate(['text' => 'required|min:3']);

        \App\Models\Comment::create([
            'article_id' => $article->id,
            'user_id' => $request->user()->id,
            'text' => $request->text,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Ваш комментарий отправлен на модерацию и появится после проверки.');
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Комментарий удален.');
    }

    public function commentIndex() {
        // Берем только те, где is_approved = false
        $comments = Comment::where('is_approved', false)->latest()->get();
        return view('comments.index', compact('comments'));
    }

    public function approveComment(Comment $comment) {
        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Комментарий одобрен.');
    }
}
