<?php

namespace Database\Factories;

use App\Models\Characteristic;
use App\Models\Product;
use App\Models\Term;
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
        $status = $this->faker->randomElement(Product::statusesList('key'));

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->numberBetween(50, 5000),
            'slug' => $this->faker->slug(),
            'status' => $status,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $categories = Term::whereProductCategories()->inRandomOrder()->take(rand(1, 5))->pluck('id');
            $brand_id = rand(1,2) == 1 ? Term::whereBrands()->inRandomOrder()->first()->id ?? null : null;

            $characteristics = Characteristic::query()
                ->inRandomOrder()
                ->whereHas('attribute.categories', function (Builder $query) use ($categories) {
                    $query->whereIn('terms.id', $categories);
                })
                ->take(rand(1, 5))
                ->pluck('id');

            $product->categories()->sync($categories);
            $product->characteristics()->sync($characteristics);

            $product->update([
                'category_id' => $categories[0],
                'brand_id' => $brand_id,
                'old_price' => rand(1, 3) === 1
                    ? $this->faker->numberBetween($product->price, $product->price * 1.5)
                    : 0,
            ]);

            try {
                $product->addMediaFromUrl('https://picsum.photos/600/400')
                    ->toMediaCollection('images');
            }catch (\Exception $exception){

            }
        });
    }
}
