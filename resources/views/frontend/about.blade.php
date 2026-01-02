@extends('frontend.layout')

@section('content')
<div class="bg-light pt-5 pb-3">
    <div class="container text-center pt-3 pb-1">
        <h1 class="display-4 fw-bold">Tentang Kami</h1>
        <p class="lead text-muted">Melangkah lebih jauh dengan kualitas original terbaik.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="https://images.unsplash.com/photo-1556906781-9a412961c28c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow img" alt="About Us">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold mb-4">Dedikasi Untuk Pecinta Sepatu</h2>
            <p>Kami percaya bahwa sepatu bukan sekadar alas kaki, melainkan representasi dari identitas dan kenyamanan setiap langkah Anda. Sejak didirikan, kami berkomitmen untuk menyediakan produk original dari berbagai merk ternama.</p>
            <div class="row g-4 mt-2">
                <div class="col-6">
                    <h4 class="fw-bold text-primary">100% Original</h4>
                    <p class="small text-muted">Semua produk kami dijamin keasliannya langsung dari distributor resmi.</p>
                </div>
                <div class="col-6">
                    <h4 class="fw-bold text-primary">Cepat & Aman</h4>
                    <p class="small text-muted">Sistem pengiriman yang terintegrasi memastikan barang sampai tepat waktu.</p>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white border-start border-primary border-4 shadow-sm h-100 rounded-4">
                        <h3 class="fw-bold mb-3">Visi Kami</h3>
                        <p class="text-muted">Menjadi destinasi utama pecinta alas kaki di Indonesia dengan mengedepankan keaslian produk dan layanan pelanggan yang tak tertandingi, sehingga setiap langkah pelanggan menjadi lebih bermakna.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4 bg-white border-start border-primary border-4 shadow-sm h-100 rounded-4">
                        <h3 class="fw-bold mb-3">Misi Kami</h3>
                        <ul class="text-muted ps-3">
                            <li>Hanya mengkurasi produk 100% original dari distributor resmi.</li>
                            <li>Memberikan edukasi mengenai perawatan sepatu kepada komunitas.</li>
                            <li>Memastikan pengalaman belanja online yang mudah, cepat, dan transparan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-primary py-5 my-5 rounded-4 shadow-sm container">
    <div class="row text-center text-white g-4">
        <div class="col-md-3 col-6 border-end border-white border-opacity-25">
            <h2 class="fw-bold mb-0">5K+</h2>
            <p class="small mb-0">Produk Terjual</p>
        </div>
        <div class="col-md-3 col-6 border-md-end border-white border-opacity-25">
            <h2 class="fw-bold mb-0">2K+</h2>
            <p class="small mb-0">Pelanggan Puas</p>
        </div>
        <div class="col-md-3 col-6 border-end border-white border-opacity-25">
            <h2 class="fw-bold mb-0">15+</h2>
            <p class="small mb-0">Brand Ternama</p>
        </div>
        <div class="col-md-3 col-6">
            <h2 class="fw-bold mb-0">4.9</h2>
            <p class="small mb-0">Rating Google</p>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Kenapa Memilih Kami?</h2>
        <p class="text-muted">Alasan mengapa ribuan pecinta sepatu memilih kami.</p>
    </div>
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4 border rounded-4 bg-white h-100 shadow-hover">
                <div class="mb-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                        <path d="M8 14.933a.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067v13.866zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.186.786 1.103 1.103 0 0 1-.868 0 7.16 7.16 0 0 1-1.186-.786 11.772 11.772 0 0 1-2.517-2.453c-1.678-2.195-3.061-5.513-2.465-9.99a1.541 1.541 0 0 1 1.044-1.263 62.456 62.456 0 0 1 2.887-.87z" />
                        <path d="M10.854 5.854a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                    </svg>
                </div>
                <h5 class="fw-bold">Garansi Keaslian</h5>
                <p class="small text-muted">Kami menjamin uang kembali 10x lipat jika produk yang Anda terima terbukti palsu.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border rounded-4 bg-white h-100 shadow-hover">
                <div class="mb-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 7V3.5h.5a.5.5 0 0 1 .5.5v3h-1z" />
                    </svg>
                </div>
                <h5 class="fw-bold">Pengiriman Cepat</h5>
                <p class="small text-muted">Bekerja sama dengan ekspedisi terbaik untuk memastikan sepatu sampai dengan selamat.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border rounded-4 bg-white h-100 shadow-hover">
                <div class="mb-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-1.1 2c.134.44.2.908.2 1.385 0 2.442-1.983 4.425-4.425 4.425s-4.425-1.983-4.425-4.425c0-1.236.508-2.355 1.325-3.158l1.376 1.14a2.895 2.895 0 0 0-.901 2.018c0 1.6 1.3 2.9 2.9 2.9s2.9-1.3 2.9-2.9c0-.28-.042-.553-.12-.813l1.75-.75z" />
                        <path d="M4.466 9H.534a.25.25 0 0 1-.192-.41l1.966-2.36a.25.25 0 0 1 .384 0l1.966 2.36a.25.25 0 0 1-.192.41zm1.1-2c-.134-.44-.2-.908-.2-1.385 0-2.442 1.983-4.425 4.425-4.425s4.425 1.983 4.425 4.425c0 1.236-.508 2.355-1.325 3.158l-1.376-1.14c.41.343.72.78.901 1.258l-1.75.75z" />
                    </svg>
                </div>
                <h5 class="fw-bold">Tukar Ukuran</h5>
                <p class="small text-muted">Kekecilan atau kebesaran? Jangan khawatir, Anda dapat menukar ukuran dalam 3 hari.</p>
            </div>
        </div>
    </div>
</div>
<div class="bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-5">
                <h3 class="fw-bold mb-4">Berikan Review</h3>
                <div class="card border-0 shadow-sm p-4">
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama Anda">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select text-warning" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Buruk)</option>
                                <option value="1">⭐ (Sangat Buruk)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea name="comment" class="form-control" rows="4" required placeholder="Tulis pengalaman Anda belanja di sini..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill">Kirim Review</button>
                    </form>
                </div>
            </div>

            <div class="col-md-7 ps-md-5">
                <h3 class="fw-bold mb-4">Apa Kata Mereka?</h3>
                <div class="review-list shadow-sm rounded-4 p-4 bg-light" style="max-height: 500px; overflow-y: auto;">
                    @forelse($reviews as $review)
                    <div class="review-item mb-4 border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0">{{ $review->name }}</h6>
                            <span class="text-warning">
                                {!! str_repeat('★', $review->rating) !!}{!! str_repeat('☆', 5 - $review->rating) !!}
                            </span>
                        </div>
                        <p class="text-muted small mb-1 italic">"{{ $review->comment }}"</p>
                        <small class="text-secondary" style="font-size: 0.75rem;">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <p class="text-muted">Belum ada review. Jadilah yang pertama!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .img {
        width: 100%;
        /* Disesuaikan agar responsif di kolom */
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .shadow-hover {
        transition: all 0.3s ease;
    }

    .shadow-hover:hover {
        transform: translateY(-10px);
        shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        border-color: #0d6efd !important;
    }

    /* Memperbaiki tampilan border responsif pada statistik */
    @media (max-width: 768px) {
        .border-md-end {
            border-right: none !important;
        }

        .img {
            max-width: 400px;
            max-height: fit-content;
        }
    }
</style>
@endsection