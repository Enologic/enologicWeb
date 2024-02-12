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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->unique();
            $table->enum('grape_type', [
                'Chardonnay',
                'Sauvignon Blanc',
                'Riesling',
                'Cabernet Sauvignon',
                'Merlot',
                'Pinot Noir',
                'Syrah',
                'Zinfandel',
                'Malbec',
                'Tempranillo',
                'Sangiovese',
                'Chenin Blanc',
                'Gewürztraminer',
            ]);
            $table->enum('wine_type', [
                'Tinto',
                'Blanco',
                'Rosado',
                'Espumoso',
                'Dulce',
                'Fortificado',
                'Natural',
            ]);
           $table->text('description');
           $table->decimal('price', 7, 2);
           $table->integer('age');
           $table->string('origin');
           $table->string('country');
            $table->timestamps();
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
