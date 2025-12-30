<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepatu;
use App\Models\KategoriSepatu;
use App\Models\Konfigurasi;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    // index
    public function index(Request $request)
    {
        $sepatu = Sepatu::with('kategori')->latest()->take(4)->get();
        $konfigurasi = Konfigurasi::first();
        $kategoriSepatu = KategoriSepatu::all();
        $query = Sepatu::query();
        // 1. Smart Search Functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_sepatu', 'like', '%' . $search . '%')
                    ->orWhere('merk', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter harga sepatu
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // 3. filter warna dan ukuran
        if ($request->filled('warna')) {
            $query->where('warna', $request->warna);
        }
        if ($request->filled('ukuran')) {
            $query->where('ukuran', $request->ukuran);
        }
        $sepatu = $query->latest()->paginate(4);
        return view('frontend.beranda', compact('sepatu', 'konfigurasi', 'kategoriSepatu'));
    }

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

    public function listSepatu(Request $request)
    {
        $query = Sepatu::query();

        // 1. Smart Search Functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_sepatu', 'like', '%' . $search . '%')
                    ->orWhere('merk', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter harga sepatu
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // 3. filter warna dan ukuran
        if ($request->filled('warna')) {
            $query->where('warna', $request->warna);
        }
        if ($request->filled('ukuran')) {
            $query->where('ukuran', $request->ukuran);
        }

        $sepatu = $query->latest()->paginate(12);
        $kategoriSepatu = KategoriSepatu::all();
        return view('frontend.list', compact('sepatu', 'kategoriSepatu'));
    }

    // about

    public function about()
    {
        $kategoriSepatu = KategoriSepatu::all();
        $konfigurasi = Konfigurasi::first();
        return view('frontend.about', compact('kategoriSepatu', 'konfigurasi'));
    }

    // contact

    public function contact()
    {
        $kategoriSepatu = KategoriSepatu::all();
        $konfigurasi = Konfigurasi::first();
        return view('frontend.contact', compact('kategoriSepatu', 'konfigurasi'));
    }

    public function toggleWishlist(Request $request)
    {
        $id = $request->sepatu_id;
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            $status = 'removed';
        } else {
            $wishlist[$id] = [
                "id" => $id,
                "added_at" => now()
            ];
            $status = 'added';
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'status' => $status,
            'wishlist_count' => count($wishlist)
        ]);
    }

    public function indexWishlist()
    {
        $wishlistSession = session()->get('wishlist', []);
        $ids = array_keys($wishlistSession);
        $kategoriSepatu = KategoriSepatu::all();

        // Ambil data sepatu dari database berdasarkan ID yang ada di session
        $wishlist = \App\Models\Sepatu::whereIn('id', $ids)->get();

        return view('frontend.wishlist', compact('wishlist', 'kategoriSepatu'));
    }
}
