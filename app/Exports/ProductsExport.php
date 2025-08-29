<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings, WithColumnWidths
{
    protected array $filters = [];
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::query()
            ->filter($this->filters)
            ->with(['category', 'brand', 'characteristics.attribute', 'media', 'seo'])
            ->get()
            ->map(function (Product $product) {
                return [
                    'name'         => $product->name,
                    'price'        => $product->price,
                    'old_price'    => $product->old_price,
                    'description'  => $product->description,
                    'category'     => optional($product->category)->name,
                    'categories'   => $this->formatCategories($product),
                    'brand'        => optional($product->brand)->name,
                    'attributes'   => $this->formatAttributes($product),
                    'images'       => $this->getImageUrls($product),
                    'status'       => $product->status,
                    'quantity'     => $product->quantity,
                    'seo' => $product->seo,
                ];
            });
    }

    public function setFilters(array $filters): static
    {
        $this->filters = $filters;

        return $this;
    }

    protected function formatAttributes(Product $product): string
    {
        return $product->characteristics
            ->map(function ($char) {
                return "{$char->attribute->name}: {$char->name}";
            })
            ->implode(' | ');
    }

    protected function formatCategories(Product $product): string
    {
        return $product->categories
            ->map(function ($char) {
                return $char->name;
            })
            ->implode(' | ');
    }

    protected function getImageUrls(Product $product): string
    {
        return $product->media
            ->map(fn ($img) => $img->getUrl())
            ->implode(', ');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Price',
            'Old Price',
            'Description',
            'Category',
            'Categories',
            'Brand',
            'Attributes',
            'Images',
            'Status',
            'Quantity',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 50, // Name
            'B' => 10, // Price
            'C' => 10, // Old Price
            'D' => 120, // Description
            'E' => 40, // Category
            'F' => 150, // categories
            'G' => 20, // Brand
            'H' => 120, // Attributes
            'I' => 100, // Images
            'J' => 100, // Status
            'K' => 100, // Quantity
        ];
    }
}
