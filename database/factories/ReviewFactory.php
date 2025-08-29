<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
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
            'rating' => rand(1,5),
            'status' => $status,
            ...$relation
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Review $review) {
            if (rand(1, 5) <= 4) {
                $parent = Review::query()->inRandomOrder()->where('id', '<>', $review->id)->first();
                $user = User::query()->inRandomOrder()->first();
                if ($parent) {
                    $review->update([
                        'parent_id' => $parent->id,
                        'model_type' => $parent->model_type,
                        'model_id' => $parent->model_id,
                        'name' => $user?->name ?? fake()->name(),
                        'user_id' => $user->id,
                        'rating' => null,
                    ]);
                }
            }
        });
    }
}
