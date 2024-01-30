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
           /* $table->enum('flavour', [
                'Bug',
                'Dark',
                'Dragon',
                'Electric',
                'Fairy',
                'Fighting',
                'Fire',
                'Flying',
                'Ghost',
                'Grass',
                'Ground',
                'Ice',
                'Normal',
                'Poison',
                'Psychic',
                'Rock',
                'Steel',
                'Water',
           ]);*/
           $table->text('description');
           $table->decimal('price', 7, 2);
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
