<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'sepatu_id'];

    public function sepatu()
    {
        return $this->belongsTo(Sepatu::class, 'sepatu_id');
    }
}
