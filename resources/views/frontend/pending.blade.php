@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card border-0 shadow-sm p-5">
                <div class="mb-4">
                    <i class="fas fa-clock fa-5x text-warning opacity-50"></i>
                </div>
                <h3 class="fw-bold">Menunggu Pembayaran</h3>
                <p class="text-muted">Pesanan Anda dengan kode: <br> <span class="badge bg-light text-dark fs-6 mt-2">#{{ $order_id }}</span></p>

                <div class="alert alert-info py-3 mt-4 text-start">
                    <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i> Instruksi:</h6>
                    <ol class="small mb-0">
                        <li>Silahkan selesaikan pembayaran melalui aplikasi e-wallet pilihan Anda.</li>
                        <li>Gunakan QRIS yang muncul atau ikuti petunjuk di aplikasi.</li>
                        <li>Status pesanan akan berubah otomatis setelah pembayaran berhasil.</li>
                    </ol>
                </div>

                <div class="mt-4 d-grid gap-2">
                    <a href="{{ url('/') }}" class="btn btn-primary rounded-pill">Kembali Belanja</a>
                    <button onclick="location.reload()" class="btn btn-outline-secondary rounded-pill">Cek Status Pembayaran</button>
                </div>

                <hr class="my-4">
                <p class="small text-muted mb-0">Butuh bantuan? Hubungi WhatsApp kami di <a href="#" class="text-decoration-none fw-bold">0812-xxxx-xxxx</a></p>
            </div>
        </div>
    </div>
</div>
@endsection