@extends('frontend.layout')

@section('content')
<div class="bg-light py-5">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold">Tentang Kami</h1>
        <p class="lead text-muted">Melangkah lebih jauh dengan kualitas original terbaik.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img src="https://images.unsplash.com/photo-1556906781-9a412961c28c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow" alt="About Us">
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
            </div>
        </div>
    </div>
</div>
@endsection