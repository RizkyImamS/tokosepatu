<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Http\Request;
use App\Models\KategoriSepatu;
use App\Models\OrderItem;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;

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
        $ukuran = $request->ukuran; // Ambil ukuran dari AJAX

        // 1. Validasi ketersediaan stok di kolom JSON
        $stokPerUkuran = $sepatu->stok_per_ukuran; // Kolom JSON
        $stokTersedia = $stokPerUkuran[$ukuran] ?? 0;

        if ($stokTersedia <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Stok ukuran ini habis!'], 422);
        }

        $cart = session()->get('cart', []);

        // 2. Gunakan kunci unik: ID_UKURAN
        $cartKey = $id . '_' . $ukuran;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "id" => $id, // Simpan ID asli untuk database nanti
                "nama" => $sepatu->nama_sepatu,
                "quantity" => 1,
                "harga" => $sepatu->harga,
                "ukuran" => $ukuran, // Simpan ukuran terpilih
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

    public function changeQuantity(Request $request)
    {
        $cartKey = $request->id; // Menggunakan kunci ID_UKURAN
        $action = $request->action;
        $cart = session()->get('cart');

        if (isset($cart[$cartKey])) {
            if ($action === 'decrease') {
                if ($cart[$cartKey]['quantity'] > 1) {
                    $cart[$cartKey]['quantity']--;
                }
            } else {
                // Opsional: Tambahkan cek stok maksimal di sini jika perlu
                $cart[$cartKey]['quantity']++;
            }
            session()->put('cart', $cart);
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }

    public function remove($cartKey)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);
        }

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'cart_count' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Produk dihapus');
    }

    public function prosesPembayaran(Request $request)
    {
        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return response()->json(['error' => 'Keranjang kosong'], 400);
            }

            $total = 0;
            $item_details = [];

            // Periksa stok sekali lagi sebelum buat transaksi
            foreach ($cart as $key => $item) {
                $sepatu = Sepatu::find($item['id']);
                $stok = $sepatu->stok_per_ukuran[$item['ukuran']] ?? 0;

                if ($stok < $item['quantity']) {
                    return response()->json(['error' => "Stok {$item['nama']} size {$item['ukuran']} tidak cukup"], 400);
                }

                $total += $item['harga'] * $item['quantity'];
                $item_details[] = [
                    'id' => $key,
                    'price' => (int)$item['harga'],
                    'quantity' => (int)$item['quantity'],
                    'name' => substr($item['nama'] . ' (' . $item['ukuran'] . ')', 0, 50),
                ];
            }

            $shippingMethod = $request->shipping_method;
            $shippingFee = ($shippingMethod == 'J&T') ? 10000 : 0;
            if ($shippingFee > 0) {
                $item_details[] = [
                    'id' => 'SHIPPING',
                    'price' => $shippingFee,
                    'quantity' => 1,
                    'name' => 'Ongkir ' . $shippingMethod,
                ];
            }

            $grandTotal = $total + $shippingFee;
            $order_id_midtrans = 'SHOE-' . time() . '-' . uniqid();

            // Simpan Order
            $order = Order::create([
                'order_id'      => $order_id_midtrans,
                'customer_name' => $request->customer_name,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'total_price'   => $total,
                'status'        => 'pending',
                'shipping_method' => $shippingMethod,
                'shipping_fee'    => $shippingFee,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'sepatu_id'  => $item['id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['harga'],
                    'ukuran'     => $item['ukuran'], // Pastikan kolom 'ukuran' ada di tabel order_items
                ]);
            }

            $params = [
                'transaction_details' => ['order_id' => $order_id_midtrans, 'gross_amount' => (int)$grandTotal],
                'item_details' => $item_details,
                'customer_details' => ['first_name' => $request->customer_name, 'phone' => $request->phone],
            ];

            return response()->json(['snap_token' => Snap::getSnapToken($params)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderSuccess(Request $request)
    {
        $order_id = $request->query('order_id');
        $order = Order::where('order_id', $order_id)->first();

        if ($order && $order->status != 'settlement') {
            DB::transaction(function () use ($order) {
                $order->status = 'settlement';
                $order->save();

                // KURANGI STOK JSON
                foreach ($order->orderItems as $item) {
                    $sepatu = Sepatu::find($item->sepatu_id);
                    if ($sepatu) {
                        $stokSekarang = $sepatu->stok_per_ukuran;
                        $ukuran = $item->ukuran;

                        if (isset($stokSekarang[$ukuran])) {
                            $stokSekarang[$ukuran] -= $item->quantity;
                            // Pastikan stok tidak minus
                            if ($stokSekarang[$ukuran] < 0) $stokSekarang[$ukuran] = 0;

                            $sepatu->stok_per_ukuran = $stokSekarang;
                            $sepatu->save();
                        }
                    }
                }
            });
        }

        session()->forget('cart');
        $kategoriSepatu = KategoriSepatu::all();
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
