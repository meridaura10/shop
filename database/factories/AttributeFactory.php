<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Term;
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
          $categories = Term::whereProductCategories()
              ->take(rand(5,15))
              ->pluck('id');

           $attribute->categories()->sync($categories);
        });
    }
}
