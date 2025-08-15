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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('price')->default(0);
            $table->decimal('old_price')->default(0);
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreignIdFor(\App\Models\Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Product::class)->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
