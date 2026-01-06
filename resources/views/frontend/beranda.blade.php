@extends('frontend.layout')

@section('content')
<style>
    /* --- 1. Global & Hero Styles --- */
    :root {
        --primary-blue: #0d6efd;
        --soft-bg: #f8f9fa;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fcfcfc;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #000000 100%);
        padding: 120px 0 160px 0;
        color: white;
        margin-bottom: -50px;
        clip-path: polygon(0 0, 100% 0, 100% 88%, 0% 100%);
    }

    /* --- 2. Filter Card Styling --- */
    .filter-card {
        border-radius: 24px;
        margin-top: -100px;
        position: relative;
        z-index: 100;
        background: white;
        border: none;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
    }

    .form-label-custom {
        font-size: 0.7rem;
        font-weight: 700;
        color: #adb5bd;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }

    /* --- 3. Card Product Styling --- */
    .card-product {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        background: white;
    }

    .card-product:hover {
        transform: translateY(-12px);
        box-shadow: 0 22px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .brand-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary-blue);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        z-index: 10;
    }

    .card-product img {
        height: 260px;
        width: 100%;
        object-fit: cover;
        background-color: #f8f9fa;
        transition: 0.5s;
    }

    .card-product:hover img {
        transform: scale(1.05);
    }

    .price-tag {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary-blue);
    }

    .product-title {
        height: 48px;
        font-size: 1.05rem;
        font-weight: 600;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* --- 4. Extra Content Styling --- */
    .feature-box {
        padding: 35px;
        border-radius: 24px;
        background: white;
        border: 1px solid #f0f0f0;
        transition: 0.3s;
    }

    .feature-box:hover {
        border-color: var(--primary-blue);
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.05);
    }

    .feature-icon {
        width: 55px;
        height: 55px;
        background: rgba(13, 110, 253, 0.08);
        color: var(--primary-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .newsletter-section {
        background: linear-gradient(135deg, #0d6efd 0%, #000000 100%);
        border-radius: 35px;
        padding: 60px;
        color: white;
    }

    .btn-primary-custom {
        background: var(--primary-blue);
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        color: white;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: 0.3s;
    }

    .btn-primary-custom:hover {
        background: #0056b3;
        transform: scale(1.02);
        color: white;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 80px 0 120px 0;
        }

        .display-3 {
            font-size: 2.5rem;
        }

        .filter-card {
            padding: 20px;
        }

        .newsletter-section {
            padding: 40px 20px;
        }
    }
</style>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Langkah Baru, Gaya Baru</h1>
        <p class="lead opacity-75 mb-5 mx-auto" style="max-width: 600px;">Temukan koleksi sepatu original terbaik dengan penawaran spesial dan kualitas terjamin.</p>
        <a href="#produk" class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill text-primary shadow-lg border-0">Jelajahi Sekarang</a>
    </div>
</div>

<div class="container mb-5">
    <div class="card filter-card p-4">
        <form action="{{ url('/') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-4">
                <span class="form-label-custom">Cari Sepatu</span>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0"
                        placeholder="Nama, merk, atau model..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <span class="form-label-custom">Harga Max</span>
                <select name="max_price" class="form-select bg-light border-0">
                    <option value="">Semua Harga</option>
                    <option value="500000" {{ request('max_price') == '500000' ? 'selected' : '' }}>Di bawah 500rb</option>
                    <option value="1000000" {{ request('max_price') == '1000000' ? 'selected' : '' }}>Di bawah 1jt</option>
                    <option value="2500000" {{ request('max_price') == '2500000' ? 'selected' : '' }}>Di bawah 2.5jt</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <span class="form-label-custom">Kategori</span>
                <select name="kategori" class="form-select bg-light border-0">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriSepatu as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <span class="form-label-custom">Warna</span>
                <select name="warna" class="form-select bg-light border-0">
                    <option value="">Semua Warna</option>
                    @foreach(['hitam', 'putih', 'biru', 'merah', 'cokelat', 'hijau'] as $w)
                    <option value="{{ $w }}" {{ request('warna') == $w ? 'selected' : '' }}>{{ ucfirst($w) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom shadow-sm">
                        <i class="fas fa-filter me-2"></i>Terapkan
                    </button>
                    @if(request()->anyFilled(['search', 'max_price', 'kategori', 'warna']))
                    <a href="{{ url('/') }}" class="text-center small text-muted text-decoration-none">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mb-5" id="produk">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="fw-bold mb-1">
                @if(request('search')) Hasil Pencarian: "{{ request('search') }}" @else Koleksi Unggulan @endif
            </h3>
            <p class="text-muted small mb-0">Tersedia {{ $sepatu->count() }} pilihan terbaik</p>
        </div>
        <hr class="flex-grow-1 mx-4 d-none d-md-block opacity-25">
    </div>

    <div class="row g-4">
        @forelse($sepatu as $item)
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 card-product border-0 shadow-sm position-relative">
                <span class="brand-badge">{{ $item->merk }}</span>

                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->nama_sepatu }}">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 260px">
                    <i class="fas fa-image fa-3x text-muted opacity-25"></i>
                </div>
                @endif

                <div class="card-body p-4 d-flex flex-column">
                    <div class="small mb-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-tag me-1"></i> {{ $item->kategori->nama_kategori ?? 'Umum' }}</span>

                        @php $totalStok = array_sum($item->stok_per_ukuran ?? []); @endphp
                        <span class="fw-bold {{ $totalStok > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-circle small me-1"></i> {{ $totalStok > 0 ? 'Ready' : 'Habis' }}
                        </span>
                    </div>

                    <h5 class="card-title product-title mb-2 text-dark">{{ $item->nama_sepatu }}</h5>

                    <div class="price-tag mb-3">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </div>

                    <div class="mb-3 d-flex flex-wrap gap-1">
                        @foreach(array_slice($item->stok_per_ukuran ?? [], 0, 4, true) as $size => $stock)
                        @if($stock > 0)
                        <span style="font-size: 0.65rem; background: #f0f2f5; padding: 2px 6px; border-radius: 4px; color: #495057; border: 1px solid #dee2e6;">{{ $size }}</span>
                        @endif
                        @endforeach
                        @if(count($item->stok_per_ukuran ?? []) > 4)
                        <span class="text-muted small align-self-center">...</span>
                        @endif
                    </div>

                    <div class="mt-auto pt-3 border-top d-grid">
                        <a href="{{ url('/sepatu/'.$item->slug) }}" class="btn btn-primary-custom {{ $totalStok <= 0 ? 'disabled bg-secondary opacity-50' : '' }}">
                            <i class="fas fa-cart-shopping me-2"></i>Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/search.svg" alt="Empty" style="width: 200px" class="mb-4 opacity-50">
            <h4 class="fw-bold text-dark">Sepatu tidak ditemukan</h4>
            <p class="text-muted">Coba gunakan kata kunci lain atau reset filter Anda.</p>
        </div>
        @endforelse
    </div>
</div>

<div class="container my-5 py-5 border-top">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-box h-100">
                <div class="feature-icon"><i class="fas fa-shield"></i></div>
                <h5 class="fw-bold">Jaminan Original</h5>
                <p class="text-muted small mb-0">Produk 100% asli dari brand ternama. Kami memberikan garansi uang kembali jika terbukti palsu.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box h-100">
                <div class="feature-icon"><i class="fas fa-truck-fast"></i></div>
                <h5 class="fw-bold">Pengiriman Cepat</h5>
                <p class="text-muted small mb-0">Setiap pesanan diproses dengan cepat dan dikemas dengan aman menggunakan bubble wrap ekstra.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box h-100">
                <div class="feature-icon"><i class="fas fa-arrows-rotate"></i></div>
                <h5 class="fw-bold">Garansi Tukar Size</h5>
                <p class="text-muted small mb-0">Bebas tukar ukuran selama 7 hari jika ukuran yang dibeli tidak pas di kaki Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 pt-4">
    <div class="newsletter-section animate__animated animate__fadeIn">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-2">Dapatkan Diskon 15%</h2>
                <p class="mb-0 opacity-75">Dapatkan info rilis sepatu terbaru dan kode voucher eksklusif langsung di email Anda.</p>
            </div>
            <div class="col-lg-6">
                <form class="d-flex gap-2 p-2 bg-white rounded-pill shadow-sm">
                    <input type="email" class="form-control border-0 rounded-pill px-4" placeholder="Alamat email anda..." style="box-shadow: none;">
                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection