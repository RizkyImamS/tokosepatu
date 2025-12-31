<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'phone',
        'address',
        'total_price',
        'status',
    ];

    public function items()
    {
        // Ini menghubungkan 1 Order ke banyak OrderItem
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
