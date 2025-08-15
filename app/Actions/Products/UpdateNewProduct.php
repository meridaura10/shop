<?php

namespace App\Actions\Products;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateNewProduct
{
    use AsAction;

    public function handle(Product $product,array $data): Product
    {
        $product->update($data['product']);

        $categoryIds = $data['categories'];

        $categoryIds[] = $data['product']['category_id'];

        $product->categories()->sync($categoryIds);

        $product->characteristics()->sync(array_filter($data['characteristics']));

        return $product;
    }
}
