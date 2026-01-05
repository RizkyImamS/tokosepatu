@extends('frontend.layout')

@section('content')
<style>
    /* Hero Section with Diagonal Cut */
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #000000 100%);
        padding: 100px 0 140px 0;
        color: white;
        margin-bottom: -50px;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
    }

    /* Filter Card Styling */
    .filter-card {
        border-radius: 20px;
        margin-top: -80px;
        position: relative;
        z-index: 100;
        background: white;
    }

    .card-product {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
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
        padding: 8px 15px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0d6efd;
    }

    .product-title {
        height: 48px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
    }

    .size-badge-container {
        min-height: 25px;
    }

    .badge-size {
        font-size: 0.65rem;
        background: #f0f2f5;
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 2px 6px;
        border-radius: 4px;
    }
</style>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Langkah Baru, Gaya Baru</h1>
        <p class="lead opacity-75 mb-4">Temukan koleksi sepatu original terbaik dengan penawaran spesial.</p>
        <a href="#produk" class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill text-primary shadow">Jelajahi Sekarang</a>
    </div>
</div>

<div class="container mb-5">
    <div class="card filter-card border-0 shadow-lg p-4">
        <form action="{{ url('/') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-4 col-md-12">
                <label class="form-label fw-bold small text-muted text-uppercase">Cari Sepatu</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0"
                        placeholder="Nama, merk, atau model..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <label class="form-label fw-bold small text-muted text-uppercase">Harga Max</label>
                <select name="max_price" class="form-select bg-light border-0">
                    <option value="">Semua Harga</option>
                    <option value="500000" {{ request('max_price') == '500000' ? 'selected' : '' }}>Di bawah 500rb</option>
                    <option value="1000000" {{ request('max_price') == '1000000' ? 'selected' : '' }}>Di bawah 1jt</option>
                    <option value="2500000" {{ request('max_price') == '2500000' ? 'selected' : '' }}>Di bawah 2.5jt</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-bold small text-muted text-uppercase">Kategori</label>
                <select name="kategori" class="form-select bg-light border-0">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriSepatu as $kat) {{-- Pastikan Anda mengirim data $kategoris dari Controller --}}
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2 col-md-4">
                <label class="form-label fw-bold small text-muted text-uppercase">Warna</label>
                <select name="warna" class="form-select bg-light border-0 text-capitalize">
                    <option value="">Semua Warna</option>
                    @foreach(['hitam', 'putih', 'biru', 'merah', 'cokelat', 'hijau'] as $w)
                    <option value="{{ $w }}" {{ request('warna') == $w ? 'selected' : '' }}>{{ $w }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2 shadow-sm">
                        <i class="fas fa-filter me-1"></i> Terapkan
                    </button>
                    @if(request()->anyFilled(['search', 'max_price', 'ukuran', 'warna']))
                    <a href="{{ url('/') }}" class="btn btn-secondary btn-sm text-decoration-none text-white rounded-pill fw-bold">Hapus Filter</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mb-5" id="produk">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">
                @if(request('search')) Hasil Pencarian: "{{ request('search') }}" @else Koleksi Unggulan @endif
            </h3>
            <p class="text-muted mb-0">Menampilkan {{ $sepatu->count() }} pasang sepatu terbaik</p>
        </div>
        <hr class="flex-grow-1 ms-4 d-none d-md-block opacity-25">
    </div>

    <div class="row">
        @forelse($sepatu as $item)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm card-product position-relative">
                <span class="brand-badge">{{ $item->merk }}</span>

                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->nama_sepatu }}">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light text-secondary" style="height: 250px">
                    <i class="fas fa-image fa-3x opacity-25"></i>
                </div>
                @endif

                <div class="card-body p-4 d-flex flex-column">
                    <div class="text-muted small mb-2 d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-tag me-1"></i> {{ $item->kategori->nama_kategori ?? 'Umum' }}</span>

                        {{-- Hitung Total Stok dari JSON --}}
                        @php $totalStok = array_sum($item->stok_per_ukuran ?? []); @endphp

                        <span class="badge {{ $totalStok > 0 ? 'text-success' : 'text-danger' }} bg-light border-0 px-0">
                            <i class="fas fa-check-circle me-1"></i> {{ $totalStok > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>

                    <h5 class="card-title fw-bold product-title mb-2 text-dark">{{ $item->nama_sepatu }}</h5>

                    <div class="price-tag mb-3">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </div>

                    {{-- Daftar Ukuran Tersedia --}}
                    <div class="size-badge-container mb-3 d-flex flex-wrap gap-1">
                        @php $count = 0; @endphp
                        @foreach($item->stok_per_ukuran ?? [] as $size => $stock)
                        @if($stock > 0)
                        <span class="badge-size">{{ $size }}</span>
                        @endif
                        @endforeach
                        @if(count(array_filter($item->stok_per_ukuran ?? [])) > 5)
                        <span class="text-muted small">+ lainnya</span>
                        @endif
                    </div>

                    <div class="mt-auto pt-3 border-top">
                        <div class="d-grid gap-2 d-flex">
                            <a href="{{ url('/sepatu/'.$item->slug) }}" class="btn btn-outline-primary flex-grow-1 btn-buy {{ $totalStok <= 0 ? 'disabled' : '' }}">
                                <i class="fas fa-cart-plus"></i> Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/not-found.svg" alt="Empty" style="width: 200px" class="mb-4">
            <h4 class="text-muted">Maaf, koleksi sepatu belum tersedia.</h4>
            <p>Silakan gunakan filter lain atau hubungi admin.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection