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
        Schema::create('product_wishlist', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('wishlist_id')->references('id')->on('wishlists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_wishlists');
    }
};
