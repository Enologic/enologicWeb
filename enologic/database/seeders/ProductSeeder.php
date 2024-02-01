<?php

namespace Database\Seeders;
use  App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $product = new Product();

       $product->product_name = "Producto 1";
       $product->description = "Prueba de producto";
       $product->price = 60;
       $product->age = 5;
       $product->origin = "Jerez de la frontera";
       $product->country = "Spain";

       $product->save();
        }
}
