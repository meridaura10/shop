<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        Brand::factory()->count(10)->create();
        Category::factory()->count(25)->create();

        Attribute::factory()->count(8)->create();
        Characteristic::factory()->count(100)->create();

        Product::factory()->count(100)->create();

        Order::factory()->count(100)->create();

        Article::factory()->count(100)->create();

        Review::factory()->count(100)->create();
    }
}
