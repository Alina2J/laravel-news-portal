<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Policies\ArticlePolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Comment;
use App\Policies\CommentPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрируем политику
        Gate::policy(Article::class, ArticlePolicy::class);

        // ХУК: Проверяется ПЕРЕД всеми остальными проверками
        Gate::before(function ($user, $ability) {
            if ($user->isModerator()) {
                return true; // Модератору можно всё
            }
        });

        Gate::policy(Comment::class, CommentPolicy::class);

        Paginator::useBootstrapFive();
    }
}
