<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Fomvasss\Seo\Facades\Seo;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with('category','brand')
            ->active()
            ->paginate();

        return view('client.products.index', compact('products'));
    }

    public function show($category,Product $product): View
    {
        $product->load('media', 'categories', 'characteristics.attribute', 'brand');

        $relatedProducts = Product::query()
            ->with('category','brand', 'media')
            ->active()
            ->limit(4)
            ->get();

        Seo::setModel($product);


        return view('client.products.show', [
            'reviews' => Review::treeFor($product),
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }

    public function search(): View
    {
        return view('client.products.search');
    }
}
