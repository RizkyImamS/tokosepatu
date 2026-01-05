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

    .size-selector {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .size-selector input[type="radio"] {
        display: none;
    }

    .size-selector label {
        display: inline-block;
        padding: 12px 20px;
        border: 2px solid #eee;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 700;
        transition: all 0.3s;
    }

    .size-selector input[type="radio"]:checked+label {
        border-color: #0d6efd;
        background-color: #f0f7ff;
        color: #0d6efd;
    }

    .size-selector input[type="radio"]:disabled+label {
        background-color: #f8f9fa;
        color: #ccc;
        cursor: not-allowed;
        border-color: #eee;
    }

    .buy-section {
        padding: 25px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid #eee;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .btn-cart {
        border-radius: 12px;
        padding: 15px 25px;
        font-weight: 700;
        text-transform: uppercase;
    }
</style>

<div class="product-header mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                <li class="breadcrumb-item active">{{ $sepatu->nama_sepatu }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="rounded-4 overflow-hidden bg-light shadow-sm">
                @if($sepatu->gambar)
                <img src="{{ asset('storage/'.$sepatu->gambar) }}" class="img-fluid w-100" alt="{{ $sepatu->nama_sepatu }}">
                @else
                <div class="d-flex align-items-center justify-content-center" style="min-height: 450px">
                    <i class="fas fa-shoe-prints fa-5x text-secondary opacity-25"></i>
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-6 px-lg-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 text-uppercase">{{ $sepatu->merk }}</span>
            <h1 class="display-5 fw-bold text-dark mb-2">{{ $sepatu->nama_sepatu }}</h1>

            <div class="product-price">
                Rp {{ number_format($sepatu->harga, 0, ',', '.') }}
            </div>

            <div class="meta-info">
                <div class="spec-item">
                    <span class="spec-label">Warna</span>
                    <span class="spec-value">{{ $sepatu->warna }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Kategori</span>
                    <span class="spec-value">{{ $sepatu->kategori->nama_kategori ?? 'Umum' }}</span>
                </div>
            </div>

            <div class="product-description mb-5">
                <h5 class="fw-bold text-dark mb-3">Deskripsi Produk</h5>
                <p>{!! nl2br(e($sepatu->deskripsi)) !!}</p>
            </div>

            <div class="product-description mb-4">
                <h5 class="fw-bold text-dark mb-3">Pilih Ukuran</h5>

                <div class="size-selector">
                    @php $hasStock = false; @endphp
                    @foreach($sepatu->stok_per_ukuran ?? [] as $size => $stock)
                    @if($stock > 0)
                    @php $hasStock = true; @endphp
                    <input type="radio" name="ukuran" value="{{ $size }}" id="size{{ $size }}">
                    <label for="size{{ $size }}">
                        {{ $size }}
                        <small class="d-block fw-normal text-muted" style="font-size: 0.6rem">Stok: {{ $stock }}</small>
                    </label>
                    @else
                    <input type="radio" name="ukuran" value="{{ $size }}" id="size{{ $size }}" disabled>
                    <label for="size{{ $size }}" title="Stok Habis">
                        {{ $size }}
                        <small class="d-block fw-normal" style="font-size: 0.6rem">Habis</small>
                    </label>
                    @endif
                    @endforeach
                </div>

                <div class="buy-section mt-4">
                    <div class="row g-2">
                        <div class="col-9">
                            <button type="button" class="btn btn-primary btn-cart w-100 shadow-sm add-to-cart-btn"
                                data-id="{{ $sepatu->id }}" {{ !$hasStock ? 'disabled' : '' }}>
                                <i class="fas fa-cart-plus me-2"></i> Tambah Ke Keranjang
                            </button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-cart btn-outline-danger btn-wishlist" data-id="{{ $sepatu->id }}">
                                <i class="{{ in_array($sepatu->id, session('wishlist', [])) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    @if(!$hasStock)
                    <p class="text-danger small mt-3 mb-0 text-center"><i class="fas fa-info-circle"></i> Maaf, semua ukuran kosong.</p>
                    @endif
                </div>
            </div>

            <div class="pt-4 border-top">
                <a href="{{ url('/') }}" class="text-decoration-none text-primary fw-bold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali Belanja
                </a>
            </div>
        </div>
    </div>
</div>
@endsection