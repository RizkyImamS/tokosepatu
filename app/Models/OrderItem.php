<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sepatu_id',
        'quantity',
        'price',
    ];

    public function sepatu()
    {
        return $this->belongsTo(Sepatu::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
