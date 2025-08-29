<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function favoriteToggleProduct(Product $product): RedirectResponse
    {
         favorite()->toggle($product);

        return redirect()->back();
    }

    public function favoriteToggleArticle(Article $article): RedirectResponse
    {
        favorite()->toggle($article);

        return redirect()->back();
    }
}
