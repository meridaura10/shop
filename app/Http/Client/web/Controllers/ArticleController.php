<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Fomvasss\Seo\Facades\Seo;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::active()
            ->orderBy('weight', 'desc')
            ->paginate(15);

        return view('client.articles.index', compact('articles'));
    }

    public function show(Article $article): View
    {
        $article->load('media', 'category');

        Seo::setModel($article);

        return view('client.articles.show', compact('article'));
    }
}
