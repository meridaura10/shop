<?php

namespace App\Actions\Products;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewProduct
{
    use AsAction;

    public function handle(array $data): Product
    {
        $product = Product::query()->create($data['product']);

        $categoryIds =  $data['categories'] ?? [];

        $categoryIds[] = $data['product']['category_id'];

        $product->categories()->attach($categoryIds);

        $product->characteristics()->sync($data['characteristics'] ?? []);

        return $product;
    }
}
