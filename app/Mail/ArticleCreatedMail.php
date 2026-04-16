<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article; // Переменная будет доступна в шаблоне Blade

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function build()
    {
        return $this->subject('На сайте опубликована новая статья!')
                    ->view('mail.article_created'); // Путь к шаблону
    }
}
