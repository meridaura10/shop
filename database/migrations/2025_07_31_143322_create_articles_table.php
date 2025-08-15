<?php

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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index()->nullable();
            $table->string('description')->nullable();
            $table->string('slug')->unique()->index()->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->integer('weight')->default(0);
            $table->timestamps();

            $table->foreignId('category_id')->nullable()->constrained('terms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
