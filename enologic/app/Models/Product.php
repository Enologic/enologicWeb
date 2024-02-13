<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'grape_type',
        'wine_type',
        'description',
        'price',
        'age',
        'origin',
        'country',
    ];

    protected $casts = [
        'grape_type' => 'string', // Definir como tipo string
        'wine_type' => 'string', // Definir como tipo string
    ];

    public static function getGrapeTypes(){
        return [
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
        ];
    }

    public static function getWineTypes(){
        return [
            'Tinto',
            'Blanco',
            'Rosado',
            'Espumoso',
            'Dulce',
            'Fortificado',
            'Natural',
        ];
    }

    public function images(){
        return $this->hasMany(Image::class,  "product_id");
    }

    public function carts(){
        return $this->belongsToMany(Cart::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function wishlists(){
    return $this->belongsToMany(Wishlist::class);
}

}
