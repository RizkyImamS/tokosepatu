@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card border-0 shadow-lg p-5 animate__animated animate__fadeInUp" style="border-radius: 20px;">
                <div class="mb-4">
                    <div class="success-checkmark">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                </div>

                <h2 class="fw-bold text-success mb-3">Pembayaran Berhasil!</h2>
                <p class="text-muted">Terima kasih atas kepercayaan Anda. Pesanan Anda telah kami terima dan sedang dalam proses penyiapan.</p>

                <div class="bg-light p-3 rounded-3 mb-4">
                    <span class="d-block small text-muted text-uppercase fw-bold">ID Pesanan</span>
                    <h5 class="fw-bold mb-0">#{{ $order_id ?? 'INV-' . time() }}</h5>
                </div>

                <div class="alert alert-success border-0 small">
                    <i class="fas fa-truck me-2"></i> Estimasi pengiriman 2-4 hari kerja tergantung lokasi Anda.
                </div>

                <div class="d-grid gap-2 mt-4">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="fas fa-shopping-bag me-2"></i> Lanjut Belanja
                    </a>
                    <a href="{{ route('order.invoice', $order_id) }}" target="_blank" class="btn btn-outline-secondary btn-lg rounded-pill">
                        <i class="fas fa-file-invoice me-2"></i> Cetak Invoice
                    </a>
                </div>

                <p class="mt-4 small text-muted">Konfirmasi juga telah dikirimkan ke nomor WhatsApp Anda.</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animasi Centang Sederhana */
    .success-checkmark {
        width: 80px;
        height: 115px;
        margin: 0 auto;
    }

    .check-icon {
        width: 80px;
        height: 80px;
        position: relative;
        border-radius: 50%;
        box-sizing: content-box;
        border: 4px solid #4CAF50;
    }

    .check-icon::before {
        top: 3px;
        left: -2px;
        width: 30px;
        transform-origin: 100% 50%;
        border-radius: 100px 0 0 100px;
    }

    .check-icon::after {
        top: 0;
        left: 30px;
        width: 60px;
        transform-origin: 0 50%;
        border-radius: 0 100px 100px 0;
        animation: rotate-circle 4.25s ease-in;
    }

    .icon-line {
        height: 5px;
        background-color: #4CAF50;
        display: block;
        border-radius: 2px;
        position: absolute;
        z-index: 10;
    }

    .line-tip {
        top: 46px;
        left: 14px;
        width: 25px;
        transform: rotate(45deg);
    }

    .line-long {
        top: 38px;
        right: 8px;
        width: 47px;
        transform: rotate(-45deg);
    }

    .icon-circle {
        top: -4px;
        left: -4px;
        z-index: 10;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        position: absolute;
    }
</style>
@endsection