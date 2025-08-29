<?php

namespace App\Services\Filters;

use App\Models\Characteristic;
use App\Models\Product;
use App\Models\Term;

class GenerateCatalogFiltersService
{
    public static function generate(Term $term): array
    {
        $filters = [];

        $filters['brands'] = Term::whereBrands()
            ->whereHas('brandProducts', function ($q) use ($term) {
                $q->active()->whereHas('categories', fn($q) => $q->where('terms.id', $term->id));
            })
            ->get();

        $characteristics = Characteristic::query()
            ->with('attribute')
            ->whereHas('products', function ($q) use ($term) {
                $q->active()->whereHas('categories', fn($q) => $q->where('terms.id', $term->id));
            })->get();

        foreach ($characteristics as $characteristic) {
            $filters['characteristics'][$characteristic->attribute->name][] = $characteristic;
        }

        $filters['price']['from'] = Product::query()
            ->whereHas('categories', fn($q) => $q->where('terms.id', $term->id))
            ->active()
            ->min('price');

        $filters['price']['to'] = Product::query()
            ->whereHas('categories', fn($q) => $q->where('terms.id', $term->id))
            ->active()
            ->max('price');

        return $filters;
    }
}
