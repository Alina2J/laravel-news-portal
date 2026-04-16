<?php

namespace App\Jobs;

use App\Models\Article;
use App\Mail\ArticleCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;
    protected $email;

    // Принимаем статью и email модератора
    public function __construct(Article $article, $email)
    {
        $this->article = $article;
        $this->email = $email;
    }

    public function handle(): void
    {
        // Логика отправки почты теперь здесь
        Mail::to($this->email)->send(new ArticleCreatedMail($this->article));
    }
}