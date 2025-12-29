<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    //
    protected $fillable = [
        'kategori_sepatu_id',
        'nama_sepatu',
        'slug',
        'merk',
        'harga',
        'stok',
        'ukuran',
        'warna',
        'deskripsi',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSepatu::class, 'kategori_sepatu_id');
    }

    public function orderItems() // Tambahkan relasi ini jika ingin bisa melihat item order dari sepatu
    {
        return $this->hasMany(OrderItem::class, 'sepatu_id');
    }
}
