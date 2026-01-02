<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    //
    protected $fillable = [
        'kategori_sepatu_id',
        'nama_sepatu',
        'merk',
        'harga',
        'stok_per_ukuran',
        'warna',
        'deskripsi',
        'gambar',
        'slug'
    ];

    // Tambahkan ini agar data JSON otomatis jadi Array PHP
    protected $casts = [
        'stok_per_ukuran' => 'array',
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
