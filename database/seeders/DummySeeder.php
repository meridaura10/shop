<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Distribution;
use App\Models\Lead;
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

     //   Brand::factory()->count(10)->create();
     //   Category::factory()->count(25)->create();

        Attribute::factory()->count(10)->create();
        Characteristic::factory()->count(40)->create();

        Product::factory()->count(50)->create();

        Order::factory()->count(30)->create();

        Article::factory()->count(10)->create();

        Review::factory()->count(10)->create();

        Lead::factory()->count(1)->create();

        Distribution::factory()->count(3)->create();
    }
}
