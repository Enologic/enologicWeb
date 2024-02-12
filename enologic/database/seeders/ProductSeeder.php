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
            [
                'product_name' => 'Catena Zapata Malbec',
                'description' => 'Proveniente de Mendoza, Argentina, este Malbec de Catena Zapata es conocido por su intensidad y ricos sabores a frutas negras. Su crianza en barricas aporta complejidad y elegancia.',
                'price' => 45,
                'age' => 4,
                'origin' => 'Mendoza',
                'country' => 'Argentina',
                'grape_type' => 'Malbec',
                'wine_type' => 'Tinto',
            ],
            [
                'product_name' => 'Cloudy Bay Sauvignon Blanc',
                'description' => 'Un Sauvignon Blanc neozelandés de la reconocida bodega Cloudy Bay. Con notas herbáceas y cítricas, este vino blanco es refrescante y perfecto para acompañar mariscos.',
                'price' => 35,
                'age' => 2,
                'origin' => 'Marlborough',
                'country' => 'New Zealand',
                'grape_type' => 'Sauvignon Blanc',
                'wine_type' => 'Blanco',
            ],
            [
                'product_name' => 'Stags Leap Cabernet Sauvignon',
                'description' => 'Este Cabernet Sauvignon de Stags\' Leap en Napa Valley, California, destaca por sus taninos sedosos y sabores a moras y especias. Un vino tinto elegante con carácter.',
                'price' => 75,
                'age' => 5,
                'origin' => 'Napa Valley',
                'country' => 'USA',
                'grape_type' => 'Cabernet Sauvignon',
                'wine_type' => 'Tinto',
            ],
            [
                'product_name' => 'Penfolds Grange Shiraz',
                'description' => 'Originario de Australia, el Penfolds Grange Shiraz es un vino tinto emblemático. Con intensidad y complejidad, ofrece notas de frutas oscuras y especias, y envejece de manera excepcional.',
                'price' => 250,
                'age' => 8,
                'origin' => 'South Australia',
                'country' => 'Australia',
                'grape_type' => 'Shiraz',
                'wine_type' => 'Tinto',
            ],
            [
                'product_name' => 'Rombauer Vineyards Zinfandel',
                'description' => 'Un Zinfandel californiano de Rombauer Vineyards, conocido por su riqueza y suavidad. Con aromas a frutas maduras y un toque especiado, es perfecto para los amantes de los tintos suaves.',
                'price' => 40,
                'age' => 3,
                'origin' => 'California',
                'country' => 'USA',
                'grape_type' => 'Zinfandel',
                'wine_type' => 'Tinto',
            ],
            [
                'product_name' => 'Graham\'s Vintage Port',
                'description' => 'Un portugués Vintage Port de la casa Graham\'s. Con su profundo color y sabores intensos a frutas negras, este vino fortificado es ideal para momentos especiales.',
                'price' => 80,
                'age' => 10,
                'origin' => 'Douro Valley',
                'country' => 'Portugal',
                'grape_type' => 'Blend',
                'wine_type' => 'Fortificado',
            ],
            [
                'product_name' => 'Mumm Napa Brut Prestige',
                'description' => 'Un espumoso Brut Prestige de Mumm Napa en California. Con burbujas finas y aromas a manzana y cítricos, este champagne es perfecto para celebraciones y brindis festivos.',
                'price' => 30,
                'age' => 2,
                'origin' => 'Napa Valley',
                'country' => 'USA',
                'grape_type' => 'Blend',
                'wine_type' => 'Espumoso',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        }
}
