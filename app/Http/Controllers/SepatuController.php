<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepatu;
use App\Models\KategoriSepatu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use SebastianBergmann\CodeCoverage\Filter;

class SepatuController extends Controller
{
    // CRUD Sepatu Management
    // Sepatu index method
    public function index(Request $request)
    {
        // Code to list all sepatu
        $sepatu = Sepatu::with('kategori')->latest()->get();
        $kategoriSepatu = KategoriSepatu::all();

        return view('admin.sepatu.index', compact('sepatu', 'kategoriSepatu'));
    }

    public function create()
    {
        // Code to show form to create new
        $kategoriSepatu = KategoriSepatu::all();
        return view('admin.sepatu.create', compact('kategoriSepatu'));
    }

    public function store(Request $request)
    {
        // Code to store new sepatu
        $validatedData = $request->validate([
            'nama_sepatu' => 'required|string|max:50',
            'kategori_sepatu_id' => 'required',
            'merk' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'stok_per_ukuran' => 'required|array',
            'stok_per_ukuran.*' => 'required|integer|min:0',
            'warna' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|mimes:jpeg,png,jpg,avif|max:4096'
        ]);

        $input = $request->all();
        // Create Automitation Slug Here
        $input['slug'] = Str::slug($request->nama_sepatu);
        $input['stok_per_ukuran'] = $request->stok_per_ukuran;

        if ($request->hasFile('gambar')) {
            $input['gambar'] = $request->file('gambar')->store('sepatu_images', 'public');
        }

        Sepatu::create($input);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Code to show form to edit sepatu
        $sepatu = Sepatu::findOrFail($id);
        $kategoriSepatu = KategoriSepatu::all();
        return view('admin.sepatu.edit', compact('sepatu', 'kategoriSepatu'));
    }

    public function update(Request $request, $id)
    {
        // Code to update sepatu
        $validatedData = $request->validate([
            'nama_sepatu' => 'required|string|max:50',
            'kategori_sepatu_id' => 'required',
            'merk' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'stok_per_ukuran' => 'required|array',
            'warna' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:4096'
        ]);

        $sepatu = Sepatu::findOrFail($id);
        $input = $request->all();

        // Update Slug Here
        $input['slug'] = Str::slug($request->nama_sepatu);
        $input['stok_per_ukuran'] = $request->stok_per_ukuran;

        if ($request->hasFile('gambar')) {
            $input['gambar'] = $request->file('gambar')->store('sepatu_images', 'public');
        }

        $sepatu->update($input);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil diperbarui.');
    }

    public function show($id)
    {
        $sepatu = Sepatu::with('kategori')->findOrFail($id);
        $kategoriSepatu = KategoriSepatu::all();

        return view('admin.sepatu.show', compact('sepatu', 'kategoriSepatu'));
    }



    public function destroy($id)
    {
        // Code to delete sepatu
        $sepatu = Sepatu::findOrFail($id);

        // Delete file image from storage if exists
        if ($sepatu->gambar) {
            Storage::disk('public')->delete($sepatu->gambar);
        }

        $sepatu->delete();
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus.');
    }

    // CRUD Kategori Sepatu Management
    // Manage Kategori Sepatu

    public function kategoriIndex()
    {
        // Code to list all kategori sepatu
        $kategoriSepatu = KategoriSepatu::latest()->get();
        return view('admin.sepatu.kategori', compact('kategoriSepatu'));
    }

    public function kategoriStore(Request $request)
    {
        // Code to store new kategori sepatu
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);

        KategoriSepatu::create($validatedData);
        return redirect()->route('kategori.index')->with('success', 'Kategori sepatu berhasil ditambahkan.');
    }

    public function kategoriEdit($id)
    {
        // Code to show form to edit kategori sepatu
        $kategoriSepatu = KategoriSepatu::findOrFail($id);
        return view('admin.sepatu.kategori_edit', compact('kategoriSepatu'));
    }

    public function kategoriUpdate(Request $request, $id)
    {
        // Code to update kategori sepatu
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);

        $kategoriSepatu = KategoriSepatu::findOrFail($id);
        $kategoriSepatu->update($validatedData);
        return redirect()->route('kategori.index')->with('success', 'Kategori sepatu berhasil diperbarui.');
    }

    public function kategoriDestroy($id)
    {
        // Code to delete kategori sepatu
        $kategoriSepatu = KategoriSepatu::findOrFail($id);
        $kategoriSepatu->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori sepatu berhasil dihapus.');
    }

    // ... kode lainnya

    public function riwayat()
    {
        // Mengambil SEMUA order, diurutkan dari yang terbaru (latest)
        // with(['items.sepatu']) memastikan data detail barang ikut terbawa tanpa query berulang
        $orders = Order::with(['items.sepatu'])->latest()->paginate(10);

        return view('admin.riwayat.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status_pembayaran' => $request->status // success atau failed
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
