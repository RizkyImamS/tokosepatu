@extends('frontend.layout')

@section('content')
<style>
    .product-header {
        padding: 30px 0;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #0d6efd;
    }

    .product-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0d6efd;
        margin: 15px 0;
    }

    .product-description {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        text-align: justify;
    }

    .meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        margin: 25px 0;
    }

    .spec-item {
        flex: 1;
        min-width: 140px;
    }

    .spec-label {
        display: block;
        font-size: 0.85rem;
        color: #888;
        text-transform: uppercase;
        font-weight: 600;
    }

    .spec-value {
        font-weight: 700;
        color: #222;
        font-size: 1.1rem;
    }

    .img-main {
        border-radius: 20px;
        transition: transform 0.3s ease;
    }

    .img-container {
        overflow: hidden;
        border-radius: 20px;
        background: #f8f9fa;
        position: relative;
        cursor: zoom-in;
    }

    /* Zoom Preview Container */
    .drift-bounding-box {
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Ukuran Selector */
    .size-selector input[type="radio"] {
        display: none;
    }

    .size-selector label {
        display: inline-block;
        padding: 10px 18px;
        border: 2px solid #ddd;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .size-selector input[type="radio"]:checked+label {
        border-color: #0d6efd;
        background-color: #f0f7ff;
        color: #0d6efd;
    }

    .size-selector label:hover {
        border-color: #0d6efd;
    }

    .buy-section {
        padding: 25px;
        background: #f8f9fa;
        border-radius: 15px;
        border: 1px solid #eee;
    }

    .btn-cart {
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="product-header mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $sepatu->kategori->nama_kategori ?? 'Koleksi' }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $sepatu->nama_sepatu }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="img-container shadow-sm">
                @if($sepatu->gambar)
                <img src="{{ asset('storage/'.$sepatu->gambar) }}" class="img-fluid img-main w-100" alt="{{ $sepatu->nama_sepatu }}">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light" style="min-height: 400px">
                    <i class="fas fa-shoe-prints fa-5x text-secondary opacity-25"></i>
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-6 px-lg-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 uppercase italic">{{ $sepatu->merk }}</span>
            <h1 class="display-5 fw-bold text-dark mb-2">{{ $sepatu->nama_sepatu }}</h1>
            <p class="text-muted mb-4">Kategori: {{ $sepatu->kategori->nama_kategori ?? 'Umum' }}</p>

            <div class="product-price">
                Rp {{ number_format($sepatu->harga, 0, ',', '.') }}
            </div>

            <div class="meta-info">
                <div class="spec-item">
                    <span class="spec-label">Ukuran Tersedia</span>
                    <span class="spec-value">{{ $sepatu->ukuran }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Warna</span>
                    <span class="spec-value">{{ $sepatu->warna }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Stok Barang</span>
                    <span class="spec-value text-{{ $sepatu->stok > 0 ? 'success' : 'danger' }}">
                        {{ $sepatu->stok }} Pcs
                    </span>
                </div>
            </div>

            <div class="product-description mb-5">
                <h5 class="fw-bold text-dark mb-3">Deskripsi Produk</h5>
                {!! nl2br(e($sepatu->deskripsi)) !!}
            </div>

            <div class="buy-section">
                <div class="row g-2">
                    <div class="col-8">
                        <form action="{{ route('cart.add', $sepatu->id) }}" method="POST">
                            @csrf
                            <button type="button"
                                class="btn btn-primary btn-cart w-100 shadow-sm add-to-cart-btn" data-id="{{ $sepatu->id }}" {{ $sepatu->stok <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-cart-plus me-2"></i> Tambah Ke Keranjang
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        @php
                        // Ambil data wishlist dari session
                        $wishlistSession = session()->get('wishlist', []);

                        // Cek apakah variabel $sepatu ada, lalu cek apakah ID-nya ada di session
                        $isWishlisted = false;
                        if(isset($sepatu) && isset($wishlistSession[$sepatu->id])) {
                        $isWishlisted = true;
                        }
                        @endphp

                        <button type="button"
                            class="btn btn-cart w-100 btn-wishlist {{ $isWishlisted ? 'btn-danger text-white' : 'btn-outline-dark' }}"
                            data-id="{{ $sepatu->id ?? '' }}">
                            <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart"></i>
                        </button>
                    </div>
                    @if($sepatu->stok <= 0)
                        <p class="text-danger small mt-2 mb-0 text-center"><i class="fas fa-info-circle"></i> Maaf, stok barang sedang kosong.</p>
                        @endif
                </div>

                <div class="d-flex align-items-center gap-3 mt-4 text-muted">
                    <span class="small fw-bold">Bagikan:</span>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ url('/') }}" class="text-decoration-none text-primary fw-bold">
                        <i class="fas fa-arrow-left me-2"></i> Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection