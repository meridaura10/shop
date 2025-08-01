<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = Category::query()
            ->where('type', Category::TYPE_ARTICLE)
            ->inRandomOrder()
            ->first()
            ->id;

        $type = $this->faker->randomElement(Article::typesList('key'));

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'slug' => $this->faker->slug(),
            'type' => $type,
            'category_id' => $category_id,
            'weight' => $this->faker->numberBetween(0, 100),
        ];
    }
}
