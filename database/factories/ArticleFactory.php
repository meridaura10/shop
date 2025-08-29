<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Term;
use Database\Factories\Traits\HasFakeImageToModelTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    use HasFakeImageToModelTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = Term::whereArticleCategories()
            ->inRandomOrder()
            ->first()
            ->id;

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'slug' => $this->faker->slug(),
            'type' => $this->faker->randomElement(Article::typesList('key')),
            'category_id' => $category_id,
            'status' => $this->faker->randomElement(Article::statusesList('key')),
            'weight' => $this->faker->numberBetween(0, 100),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Article $article) {
          $this->hasFakeImageToModelTrait($article, 1);
        });
    }
}
