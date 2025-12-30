@extends('frontend.layout')

@section('title', 'Wishlist Saya - ShoeStore')

@section('content')
<div class="container section-padding">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold"><i class="fas fa-heart text-danger me-2"></i> Wishlist Saya</h2>
            <p class="text-muted">Simpan produk impianmu di sini.</p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Menggunakan @forelse untuk menangani array kosong secara otomatis --}}
        @forelse($wishlist as $item)
        {{-- Karena menggunakan Session, $item adalah model Sepatu langsung --}}
        <div class="col-md-4 col-lg-3" id="wishlist-item-{{ $item->id }}">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="position-relative">
                    @if($item->gambar)
                    <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->nama_sepatu }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                    @endif

                    {{-- Tombol Hapus Wishlist --}}
                    <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm btn-remove-wishlist"
                        data-id="{{ $item->id }}"
                        title="Hapus dari Wishlist">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-1">{{ $item->nama_sepatu }}</h6>
                    <p class="text-muted small mb-2">{{ $item->merk }}</p>
                    <p class="text-primary fw-bold mb-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                    <div class="d-grid gap-2">
                        <a href="{{ url('/sepatu/'.$item->slug) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                        <button class="btn btn-primary btn-sm add-to-cart-btn" data-id="{{ $item->id }}">
                            <i class="fas fa-cart-plus me-1"></i> + Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        {{-- Tampilan jika wishlist kosong --}}
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-heart-broken fa-4x text-light mb-3"></i>
                <h4 class="fw-bold">Wishlist Anda Kosong</h4>
                <p class="text-muted">Ayo cari sepatu favoritmu dan simpan di sini!</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3 px-4 rounded-pill">Mulai Belanja</a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection