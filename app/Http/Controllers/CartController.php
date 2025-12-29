<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Http\Request;
use App\Models\KategoriSepatu;
use App\Models\OrderItem;
use App\Models\Order;
// Hapus Redirector yang tidak terpakai agar tidak membingungkan
use Midtrans\Config;
use Midtrans\Snap;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $kategoriSepatu = KategoriSepatu::all();
        return view('frontend.cart', compact('cart', 'kategoriSepatu'));
    }

    public function add(Request $request, $id)
    {
        $sepatu = Sepatu::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $sepatu->nama_sepatu,
                "quantity" => 1,
                "harga" => $sepatu->harga,
                "gambar" => $sepatu->gambar,
                "merk" => $sepatu->merk
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'cart_count' => count($cart)
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'cart_count' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Perbaikan: Jika cart kosong, lempar balik ke halaman cart
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $kategoriSepatu = KategoriSepatu::all();
        return view('frontend.checkout', compact('kategoriSepatu', 'cart'));
    }

    public function prosesPembayaran(Request $request)
    {
        try {
            // Set Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            if (!Config::$serverKey) {
                return response()->json(['error' => 'Server Key Midtrans belum diatur di .env'], 500);
            }

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return response()->json(['error' => 'Keranjang kosong'], 400);
            }

            $total = 0;
            $item_details = [];

            foreach ($cart as $id => $item) {
                $total += $item['harga'] * $item['quantity'];

                // Disarankan mengirim item_details agar di struk Midtrans muncul nama barangnya
                $item_details[] = [
                    'id' => $id,
                    'price' => (int)$item['harga'],
                    'quantity' => (int)$item['quantity'],
                    'name' => substr($item['nama'], 0, 50), // Batasi 50 karakter
                ];
            }

            $params = [
                'transaction_details' => [
                    // PERBAIKAN: Gunakan Uniqid agar benar-benar tidak pernah duplikat
                    'order_id' => 'SHOE-' . time() . '-' . uniqid(),
                    'gross_amount' => (int)$total,
                ],
                'item_details' => $item_details,
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'phone' => $request->phone,
                    'billing_address' => [
                        'address' => $request->address,
                    ],
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        // 1. Simpan ke tabel orders
        $order = \App\Models\Order::create([
            'order_id' => 'SHOE-' . time(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // 2. Simpan detail ke order_items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'sepatu_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['harga'],
            ]);
        }

        // 3. Kirim params ke Midtrans menggunakan $order->order_id yang baru dibuat
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => (int)$total,
            ],
            // ... customer_details tetap sama
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['snap_token' => $snapToken]);
    }

    public function orderSuccess(Request $request)
    {
        $kategoriSepatu = KategoriSepatu::all();
        $order_id = $request->query('order_id');
        $cart = session()->get('cart');
        $order = \App\Models\Order::where('order_id', $order_id)->first();

        // untuk update status order menjadi 'settlement'
        if ($order) {
            $order->status = 'settlement';
            $order->save();

            $items = $order->orderItems;
            foreach ($items as $item) {
                $item->sepatu->decrement('stok', $item->quantity);
            }
        }

        if ($cart) {
            foreach ($cart as $id => $details) {
                // 1. Cari Produk berdasarkan ID
                $sepatu = Sepatu::find($id);
                if ($sepatu) {
                    // 2. Kurangi Stok
                    $sepatu->stok -= $details['quantity'];
                    $sepatu->save();
                }
            }
        }



        // Hapus keranjang setelah sukses
        session()->forget('cart');

        return view('frontend.success', compact('kategoriSepatu', 'order_id'));
    }

    public function pendingOrder($order_id) // Parameter $order_id harus ada di sini
    {
        $kategoriSepatu = \App\Models\KategoriSepatu::all();
        $order = \App\Models\Order::where('order_id', $order_id)->first();

        // Kirim order_id ke dalam view
        return view('frontend.pending', compact('order', 'kategoriSepatu', 'order_id'));
    }

    public function printInvoice($order_id)
    {
        // Jika sudah ada database, Anda bisa mencari data: Order::where('order_id', $order_id)->first();
        // Untuk sekarang, kita ambil data sederhana untuk tampilan
        $order_id = $order_id;
        $date = now()->format('d F Y H:i');

        return view('frontend.invoice', compact('order_id', 'date'));
    }
}
