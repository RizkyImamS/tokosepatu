<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSepatu extends Model
{
    protected $table = 'kategori_sepatus';

    protected $fillable = [
        'nama_kategori',
    ];

    public function sepatus(): HasMany
    {
        return $this->hasMany(Sepatu::class, 'kategori_sepatu_id');
    }
}
