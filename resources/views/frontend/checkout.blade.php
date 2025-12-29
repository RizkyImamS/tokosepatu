@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-7 mb-4">
            <h4 class="fw-bold mb-4">Informasi Pengiriman</h4>
            <div class="card border-0 shadow-sm p-4">
                <form id="formCheckout" action="{{ route('cart.proses') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="customer_name" class="form-control" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="3" required placeholder="Alamat pengiriman..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="number" name="phone" class="form-control" required placeholder="081234567xxx">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <h4 class="fw-bold mb-4">Metode Pembayaran</h4>
            <div class="card border-0 shadow-sm p-4">
                <div class="payment-methods">
                    <div class="form-check payment-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="qris" value="QRIS" form="formCheckout" checked>
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="qris">
                            <span>QRIS (All Payment)</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" height="20">
                        </label>
                    </div>

                    <div class="form-check payment-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="dana" value="DANA" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="dana">
                            <span>DANA</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" height="20">
                        </label>
                    </div>

                    <div class="form-check payment-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="gopay" value="GOPAY" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="gopay">
                            <span>GoPay</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" height="20">
                        </label>
                    </div>

                    <div class="form-check payment-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="ovo" value="OVO" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="ovo">
                            <span>OVO</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" height="20">
                        </label>
                    </div>
                </div>

                <div class="mt-4 bg-light p-3 rounded">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Belanja:</span>
                        @php $total = 0; foreach(session('cart') as $details) { $total += $details['harga'] * $details['quantity']; } @endphp
                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-primary">
                        <span class="fw-bold">Total Bayar:</span>
                        <h4 class="fw-bold mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <button type="submit" form="formCheckout" class="btn btn-primary w-100 mt-4 btn-lg rounded-pill shadow">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-option {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd !important;
    }

    .form-check-input:checked+.form-check-label {
        font-weight: bold;
    }
</style>
@endsection