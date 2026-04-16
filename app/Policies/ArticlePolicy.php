<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    // Просмотр доступен всем (даже гостям, если не защищено middleware)
    public function viewAny(?User $user) { return true; }

    // Создание, обновление и удаление — только для модератора
    public function create(User $user)
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Вы не являетесь модератором и не можете создавать новости.');
    }

    public function update(User $user, Article $article)
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('У вас нет прав на редактирование этой новости.');
    }

    public function delete(User $user, Article $article)
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Удаление новостей доступно только администрации.');
    }
}