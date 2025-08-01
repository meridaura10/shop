<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->numberBetween(50, 5000),
            'slug' => $this->faker->slug(),
            'brand_id' => Brand::query()->inRandomOrder()->first()->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $categories = Category::query()->inRandomOrder()->take(rand(1, 5))->pluck('id');
            $characteristics = Characteristic::query()
                ->inRandomOrder()
                ->whereHas('attribute.categories', function (Builder $query) use ($categories) {
                    $query->whereIn('categories.id', $categories);
                })
                ->take(rand(1, 5))
                ->pluck('id');

            $product->categories()->sync($categories);
            $product->characteristics()->sync($characteristics);

            $product->update([
                'category_id' => $categories[0],
                'old_price' => rand(1, 3) === 1
                    ? $this->faker->numberBetween($product->price, $product->price * 1.5)
                    : 0,
            ]);
        });
    }
}
