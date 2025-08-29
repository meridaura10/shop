<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Attribute;
use App\Models\Characteristic;
use App\Models\Distribution;
use App\Models\Favorite;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        Attribute::factory()->count(8)->create();
        Characteristic::factory()->count(20)->create();

        Product::factory()->count(200)->create();

        Order::factory()->count(100)->create();

        Article::factory()->count(10)->create();

        Review::factory()->count(1000)->create();

        Lead::factory()->count(1)->create();

        Distribution::factory()->count(3)->create();

        Favorite::factory()->count(150)->create();
    }
}
