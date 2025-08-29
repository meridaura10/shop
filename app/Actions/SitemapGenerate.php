<?php

namespace App\Actions;

use App\Models\Article;
use App\Models\Page;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Action;

class SitemapGenerate extends Action
{
    public function handle(): void
    {
        $urls = [
            url('/'),
            url('/articles'),
            url('/catalog'),
        ];

        foreach (Page::all() as $page) {
            $urls[] = url($page->slug);
        }

        Term::whereProductCategories()->active()->chunk(100, function ($categories) use (&$urls) {
            foreach ($categories as $category) {
                $urls[] = url('/catalog/' . $category->slug);

                Product::query()->active()->where('category_id', $category->id)->chunk(100, function ($products) use (&$urls, $category) {
                    foreach ($products as $product) {
                        $urls[] = url('/catalog/'. $category->slug .'/' . $product->slug);
                    }
                });
            }
        });

        Article::query()->chunk(100, function ($articles) use (&$urls) {
            foreach ($articles as $article) {
                $urls[] = url('/articles/'. $article->slug);
            }
        });

        $xml = view('sitemap.xml', compact('urls'))->render();

        Storage::disk('public')->put('sitemap.xml', $xml);
    }

    public function getCommandSignature(): string
    {
        return 'sitemap:generate';
    }
}
