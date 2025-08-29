<?php

namespace App\Http\client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use Illuminate\View\View;
use Fomvasss\Variable\Facade as VariableFacade;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $products = Product::query()
            ->limit(8)
            ->with('media', 'category')
            ->latest()
            ->active()
            ->get();

        $articles = Article::query()
            ->limit(3)
            ->with('media')
            ->latest()
            ->active()
            ->news()
            ->get();

        return view('client.pages.home', compact('products', 'articles'));
    }
}
