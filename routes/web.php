<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriSepatuController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Models\Sepatu;
use App\Http\Controllers\CartController;

// Frontend Routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/sepatu/{id}', [FrontController::class, 'detail'])->name('sepatu.show');
// Route untuk menampilkan sepatu berdasarkan kategori di sisi User/Frontend
Route::get('/kategori/{id}', [FrontController::class, 'category'])->name('frontend.category');
Route::get('/list-sepatu', [FrontController::class, 'listSepatu'])->name('frontend.listSepatu');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');


//Whistlist
Route::get('/wishlist', [FrontController::class, 'indexWishlist'])->name('wishlist.index');
Route::post('/wishlist/toggle', [FrontController::class, 'toggleWishlist'])->name('wishlist.toggle');




// Halaman Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Tambah ke Keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
// Update jumlah item di keranjang
// Tambahkan baris ini di routes/web.php
Route::post('/change-quantity', [App\Http\Controllers\CartController::class, 'changeQuantity'])->name('cart.changeQuantity');
// Hapus satu item
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Halaman untuk checkout
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout/proses', [App\Http\Controllers\CartController::class, 'prosesPembayaran'])->name('cart.proses');
// Halaman setelah order pending
Route::get('/order/pending/{order_id}', [App\Http\Controllers\CartController::class, 'orderPending'])->name('order.pending');
// if order success
Route::get('/order/success', [App\Http\Controllers\CartController::class, 'orderSuccess'])->name('order.success');
// cetak invoice
Route::get('/order/invoice/{order_id}', [App\Http\Controllers\CartController::class, 'printInvoice'])->name('order.invoice');

// Authentication Routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('admin/sepatu', App\Http\Controllers\SepatuController::class);
    Route::resource('admin/konfigurasi', App\Http\Controllers\KonfigurasiController::class);
    Route::resource('admin/user', App\Http\Controllers\UserController::class);
    Route::get('/admin/riwayat', [App\Http\Controllers\SepatuController::class, 'riwayat'])->name('riwayat.index');

    // Kategori Sepatu (Menggunakan SepatuController sesuai permintaan sebelumnya)
    Route::get('admin/kategori', [SepatuController::class, 'kategoriIndex'])->name('kategori.index');
    Route::post('admin/kategori', [SepatuController::class, 'kategoriStore'])->name('kategori.store');
    Route::delete('admin/kategori/{id}', [SepatuController::class, 'kategoriDestroy'])->name('kategori.destroy');
    Route::get('/admin/kategori/{id}/edit', [SepatuController::class, 'kategoriEdit'])
        ->name('sepatu.kategori_edit');
    Route::put('/admin/kategori/{id}', [SepatuController::class, 'kategoriUpdate'])
        ->name('kategori.update');
});
