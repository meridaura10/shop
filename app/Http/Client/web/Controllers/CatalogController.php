<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Characteristic;
use App\Models\Product;
use App\Models\Term;
use App\Services\Filters\GenerateCatalogFiltersService;
use Fomvasss\Seo\Facades\Seo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $categories = Term::whereProductCategories()
            ->with('media', 'children')
            ->doesntHave('parent')
            ->get();

        return view('client.catalog.index', compact('categories'));
    }

    public function show(Request $request, Term $term): View
    {
        $term->load('children.media');

        $products = Product::query()
            ->with('media', 'categories', 'category')
            ->whereHas('categories', fn($q) => $q->where('terms.id', $term->id))
            ->filter($request->all())
            ->active()
            ->paginate();

        Seo::setModel($term);

        $filters = GenerateCatalogFiltersService::generate($term);

        return view('client.catalog.show',[
            'products' => $products,
            'filters' => $filters,
            'category' => $term,
        ]);
    }
}
