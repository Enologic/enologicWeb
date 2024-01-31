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
        'reservation'
    ];

    public function images(){
        return $this->hasMany(Image::class,  "product_id");
    }

}
