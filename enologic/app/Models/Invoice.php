<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount',
        'order_id'
    ];
    
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
