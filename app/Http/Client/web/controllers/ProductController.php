<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function show(): View
    {
//        $product->load('images','categories', 'characteristics.attribute', 'brand');

        return view('client.products.show');
    }

    public function search(): View
    {
        return view('client.products.search');
    }
}
