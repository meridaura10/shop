<?php

namespace App\Actions;

use App\Models\Product;
use Lorisleiva\Actions\Action;

class RecalculateRatingAction extends Action
{
    public function handle(): void
    {
        Product::query()->whereHas('reviews', function ($q) {
            $q->where('status', '!=', 'published');
        })->chunk(50, function ($products) {
            $products->each(function (Product $product) {
                $rating = $product->reviews()
                    ->whereNull('parent_id')
                    ->avg('rating');

                $product->update(['rating' => $rating]);
            });
        });
    }
}
