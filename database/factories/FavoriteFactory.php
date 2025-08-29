<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modelClass = $this->faker->randomElement([Product::class, Article::class]);

        $modelType = (new $modelClass())->getMorphClass();

        $modelId = $modelClass::inRandomOrder()->first()->id;

        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'model_type' => $modelType,
            'model_id' => $modelId,
        ];
    }
}
