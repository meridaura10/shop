<?php

namespace App\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Article::class);

        $articles = Article::query()
            ->with('category','media')
            ->latest()
            ->paginate();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $this->authorize('create', Article::class);

        return view('admin.articles.create');
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->authorize('create', Article::class);

        $article = Article::create($request->validated());

        $article->mediaManage($request);

        return redirect()->route('admin.articles.edit', $article);
    }

    public function edit(Article $article): View
    {
        $this->authorize('update', $article);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        $article->update($request->validated());

        $article->mediaManage($request);

        return redirect()->route('admin.articles.edit', $article);
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('admin.articles.index');
    }
}
