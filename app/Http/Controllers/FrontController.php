<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepatu;
use App\Models\KategoriSepatu;
use App\Models\Konfigurasi;

class FrontController extends Controller
{
    // index
    public function index()
    {
        $sepatu = Sepatu::with('kategori')->latest()->take(4)->get();
        $konfigurasi = Konfigurasi::first();
        $kategoriSepatu = KategoriSepatu::all();
        return view('frontend.beranda', compact('sepatu', 'konfigurasi', 'kategoriSepatu'));
    }

    // public function listSepatu()
    // {
    //     $sepatu = Sepatu::with('kategori')->latest()->paginate(12);
    //     return view('front.sepatu.list', compact('sepatu'));
    // }

    public function detail($slug)
    {
        $sepatu = Sepatu::where('slug', $slug)->firstOrFail();
        $kategoriSepatu = KategoriSepatu::all();
        return view('frontend.detail', compact('sepatu', 'kategoriSepatu'));
    }

    public function category($id)
    {
        // Ambil semua kategori untuk ditampilkan di sidebar/menu jika perlu
        $kategoriSepatu = KategoriSepatu::all();

        // Cari kategori yang dipilih
        $kategori = KategoriSepatu::findOrFail($id);

        // Ambil sepatu yang hanya memiliki kategori_id tersebut
        $sepatu = Sepatu::where('kategori_sepatu_id', $id)->get();

        return view('frontend.beranda', compact('sepatu', 'kategoriSepatu', 'kategori'));
    }
}
