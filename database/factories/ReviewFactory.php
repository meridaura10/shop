<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(Review::typesList('key'));
        $status = $this->faker->randomElement(Review::statusesList('key'));
        $relation = [];

        if($type == Review::TYPE_PRODUCT) {
            $relation = [
                'model_type' => (new Product)->getMorphClass(),
                'model_id' => Product::query()->inRandomOrder()->first()->id,
            ];
        }

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'type' => $type,
            'status' => $status,
            ...$relation
        ];
    }
}
