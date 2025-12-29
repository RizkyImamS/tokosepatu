@extends('frontend.layout')

@section('content')
<style>
    /* Custom Styling untuk Shoe Store */
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #000000 100%);
        padding: 120px 0;
        color: white;
        margin-bottom: 50px;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
    }

    .card-product {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .card-product:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .card-product img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        background-color: #f8f9fa;
    }

    .brand-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        background: white;
        color: #0d6efd;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    .btn-buy {
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .product-title {
        height: 50px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        font-size: 1.1rem;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0d6efd;
    }
</style>

<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown italic">Langkah Baru, Gaya Baru</h1>
        <p class="lead opacity-75 mb-4">Dapatkan koleksi sepatu original terbaik dengan harga yang kompetitif.</p>
        <a href="#produk" class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill text-primary shadow">Mulai Belanja</a>
    </div>
</div>

<div class="container mb-5" id="produk">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="fw-bold mb-0">Koleksi Terbaru</h3>
            <p class="text-muted mb-0">Pilihan terbaik untuk melengkapi harimu</p>
        </div>
        <hr class="flex-grow-1 ms-4 d-none d-md-block opacity-25">
    </div>

    <div class="row">
        @forelse($sepatu as $item)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm card-product">
                <span class="brand-badge">
                    {{ $item->merk }}
                </span>

                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->nama_sepatu }}">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 250px">
                    <i class="fas fa-shoe-prints fa-3x text-secondary opacity-25"></i>
                </div>
                @endif

                <div class="card-body p-4">
                    <div class="text-muted small mb-1">
                        <i class="fas fa-tag me-1"></i> {{ $item->kategori->nama_kategori ?? 'Umum' }}
                    </div>

                    <h5 class="card-title fw-bold product-title mb-2">{{ $item->nama_sepatu }}</h5>

                    <div class="price-tag mb-3">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted"><i class="fas fa-box me-1"></i> Stok: {{ $item->stok }}</span>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/sepatu/'.$item->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                Detail
                            </a>

                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <button type="button"
                                    class="btn btn-primary btn-buy py-1 px-3 add-to-cart-btn"
                                    data-id="{{ $item->id }}"
                                    {{ $item->stok <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/not-found.svg" alt="Empty" style="width: 200px" class="mb-4">
            <h4 class="text-muted">Maaf, koleksi sepatu belum tersedia.</h4>
            <p>Silakan hubungi admin untuk ketersediaan barang.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection