<?php

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->index()->nullable();
            $table->longText('description')->nullable();
            $table->decimal('old_price',)->default(0);
            $table->decimal('price',)->default(0);
            $table->integer('quantity')->default(0);
            $table->string('status')->nullable();
            $table->unsignedSmallInteger('rating')->nullable();
            $table->timestamps();

            $table->foreignId('brand_id')->nullable()->constrained('terms')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('terms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
