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
        $products = [
            [
                'product_name' => 'Marqués de Cáceres Reserva',
                'description' => 'Este vino español es un Reserva de la reconocida bodega Marqués de Cáceres. Con una mezcla armoniosa de uvas, presenta notas de frutas maduras y toques de vainilla.',
                'price' => 20,
                'age' => 3,
                'origin' => 'Rioja',
                'country' => 'Spain',
            ],
            [
                'product_name' => 'Château Margaux Grand Cru Classé',
                'description' => 'Un vino tinto francés excepcional, este Grand Cru Classé de Château Margaux es conocido por su elegancia y complejidad. Con aromas a flores y frutas negras, es una joya de Bordeaux.',
                'price' => 150,
                'age' => 5,
                'origin' => 'Bordeaux',
                'country' => 'France',
            ],
            [
                'product_name' => 'Barolo Riserva Pio Cesare',
                'description' => 'Originario de la región de Barolo en Italia, este vino Riserva de Pio Cesare es un ejemplo de la nobleza de la variedad Nebbiolo. Con notas de cereza y especias, su estructura es impresionante.',
                'price' => 90,
                'age' => 4,
                'origin' => 'Barolo',
                'country' => 'Italy',
            ],
            [
                'product_name' => 'Vega Sicilia Único',
                'description' => 'Considerado como uno de los mejores vinos de España, el Vega Sicilia Único es un vino tinto icónico. Con una crianza prolongada, presenta complejas capas de sabores y un carácter único.',
                'price' => 300,
                'age' => 6,
                'origin' => 'Ribera del Duero',
                'country' => 'Spain',
            ],
            [
                'product_name' => 'Antinori Tignanello',
                'description' => 'Este vino toscano Tignanello de la familia Antinori es una mezcla innovadora de Sangiovese, Cabernet Sauvignon y Cabernet Franc. Con taninos suaves y aromas a frutas maduras, es una joya de Italia.',
                'price' => 120,
                'age' => 8,
                'origin' => 'Tuscany',
                'country' => 'Italy',
            ],
            [
                'product_name' => 'Chardonnay de la Valle',
                'description' => 'Un vino blanco fresco y afrutado con notas cítricas y un toque de vainilla. Ideal para mariscos y platos ligeros.',
                'price' => 25,
                'age' => 2,
                'origin' => 'California',
                'country' => 'USA',
                'grape_type' => 'Chardonnay',
                'wine_type' => 'Blanco',
            ],
            [
                'product_name' => 'Dom Pérignon Vintage',
                'description' => 'Un champagne elegante y sofisticado de la prestigiosa casa de Champagne Dom Pérignon. Con burbujas finas y sabores complejos, es perfecto para celebraciones especiales.',
                'price' => 200,
                'age' => 6,
                'origin' => 'Champagne',
                'country' => 'France',
                'grape_type' => 'Pinot Noir',
                'wine_type' => 'Espumoso',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        }
}
