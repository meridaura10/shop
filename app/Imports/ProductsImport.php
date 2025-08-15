<?php

namespace App\Imports;

use App\Actions\Products\CreateNewProduct;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class ProductsImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $brand = $row['brand'] ? $this->getBrand($row['brand']) : null;
        $category = $row['category'] ? $this->getCategories($row['category'])->first() : null;
        $categories = $row['categories'] ? $this->getCategories($row['categories']) : collect();

        if($category){
            $categories->push($category);
        }

        $characteristics = $row['attributes'] ? $this->getCharacteristic($row['attributes'], $categories) : collect();

        $product = CreateNewProduct::run([
            'product' => [
                'name' => $row['name'] ?? null,
                'price' => $row['price'] ?? 0,
                'old_price' => $row['price_old'] ?? 0,
                'quantity' => $row['quantity'] ?? 0,
                'description' => $row['body'] ?? null,
                'status' => array_key_exists('published', $row) ? $row['published'] ? Product::STATUS_PUBLISHED : Product::STATUS_UNPUBLISHED : $row['status'],
                'category_id' => $category?->id,
                'brand_id' => $brand?->id,
            ],
            'categories' => $categories,
            'characteristics' => $characteristics->pluck('id'),
        ]);

        $this->setImages($row['images'] ?? '', $product);

        return $product;
    }

    public function setImages(string $images, Product $product): void
    {
        $urls = explode(',', $images);

        foreach ($urls as $url) {
            $this->addImageFromUrl($product, $url);
        }
    }

    function addImageFromUrl($product, string $url, string $collection = 'images')
    {
        $product->addMediaFromUrl($url)
            ->toMediaCollection($collection);
    }

    public function getBrand(string $name): Term
    {
        return Term::whereBrands()->firstOrCreate([
            'name' => $name,
            'vocabulary' => Term::VOCABULARY_BRANDS,
        ]);
    }

    public function getCharacteristic(string $attributes, ?Collection $categories = null): Collection
    {
        $attributesData = $attributes ? $this->parseAttributes($attributes) : [];

        $characteristics = collect();

        foreach ($attributesData as $attributeData => $characteristicData) {
            $attribute = Attribute::query()->firstOrCreate(['name' => $attributeData]);
            $attribute->categories()->attach($categories?->pluck('id'));
            $characteristic = $attribute->characteristics()->firstOrCreate(['name' => $characteristicData]);
            $characteristics->push($characteristic);
        }

        return $characteristics;
    }

    public function getCategories(string $input): Collection
    {
        $result = collect();

        $pairs = explode('|', $input);

        foreach ($pairs as $pair) {
            $category = Term::whereProductCategories()->firstOrCreate([
                'name' => $pair,
                'vocabulary' => Term::VOCABULARY_PRODUCT_CATEGORIES,
            ]);
            $result->push($category);
        }

        return $result;
    }

    function parseAttributes(string $input): array {
        $result = [];

        $pairs = explode('|', $input);

        foreach ($pairs as $pair) {
            $pair = trim($pair);

            [$attr, $value] = array_map('trim', explode(':', $pair, 2));

            $result[$attr] = $value;
        }

        return $result;
    }

    public function startRow(): int
    {
        return 1;
    }
}
