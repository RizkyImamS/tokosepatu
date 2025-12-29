<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    protected $table = 'konfigurasis';

    protected $fillable = [
        'nama_toko',
        'alamat',
        'telepon',
        'email',
        'deskripsi',
        'tentang_kami',
    ];
}
