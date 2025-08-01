<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
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
        ];
    }

    public function configure(): static
    {
       return $this->afterCreating(function (Attribute $attribute) {
          $categories = Category::query()
              ->where('type',Category::TYPE_PRODUCT)
              ->take(rand(5,15))
              ->pluck('id');

           $attribute->categories()->sync($categories);
        });
    }
}
