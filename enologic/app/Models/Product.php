<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',//Añadir enums
        'description',
        'price',
        'age',
        'origin'
    ];

    public function images(){
        return $this->hasMany(Image::class,  "product_id");
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function ordes()
    {
        return $this->belongsToMany(Order::class);
    }
}
