<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/list-sepatu', [FrontController::class, 'listSepatu'])->name('frontend.listSepatu');
Route::get('/sepatu/{id}', [FrontController::class, 'detail'])->name('sepatu.detail');
Route::get('/kategori/{id}', [FrontController::class, 'category'])->name('frontend.category');
Route::post('/review/store', [FrontController::class, 'storeReview'])->name('review.store');

// Wishlist
Route::get('/wishlist', [FrontController::class, 'indexWishlist'])->name('wishlist.index');
Route::post('/wishlist/toggle', [FrontController::class, 'toggleWishlist'])->name('wishlist.toggle');

/*
|--------------------------------------------------------------------------
| Cart & Checkout Routes
|--------------------------------------------------------------------------
*/
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{id}', 'add')->name('cart.add');
    Route::post('/change-quantity', 'changeQuantity')->name('cart.changeQuantity');
    Route::delete('/cart/remove/{id}', 'remove')->name('cart.remove');

    // Checkout Process
    Route::get('/checkout', 'checkout')->name('cart.checkout');
    Route::post('/checkout/proses', 'prosesPembayaran')->name('cart.proses');

    // Post-Payment
    Route::get('/order/pending/{order_id}', 'pendingOrder')->name('order.pending');
    Route::get('/order/success', 'orderSuccess')->name('order.success');
    Route::get('/order/invoice/{order_id}', 'printInvoice')->name('order.invoice');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Resources
    Route::resource('sepatu', SepatuController::class);
    Route::resource('konfigurasi', KonfigurasiController::class);
    Route::resource('user', UserController::class);

    // History / Riwayat
    Route::get('/riwayat', [SepatuController::class, 'riwayat'])->name('riwayat.index');
    Route::delete('/riwayat/{id}', [SepatuController::class, 'riwayatDestroy'])->name('riwayat.destroy');

    // Kategori Sepatu (Custom Logic inside SepatuController)
    Route::controller(SepatuController::class)->group(function () {
        Route::get('/kategori', 'kategoriIndex')->name('kategori.index');
        Route::post('/kategori', 'kategoriStore')->name('kategori.store');
        Route::get('/kategori/{id}/edit', 'kategoriEdit')->name('sepatu.kategori_edit');
        Route::put('/kategori/{id}', 'kategoriUpdate')->name('kategori.update');
        Route::delete('/kategori/{id}', 'kategoriDestroy')->name('kategori.destroy');
    });
});
