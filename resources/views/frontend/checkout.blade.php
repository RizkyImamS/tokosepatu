@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-7 mb-4">
            <h4 class="fw-bold mb-4">Informasi Pengiriman</h4>
            <div class="card border-0 shadow-sm p-4 mb-4">
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

            <h4 class="fw-bold mb-4">Metode Pengiriman</h4>
            <div class="card border-0 shadow-sm p-4">
                <div class="shipping-methods">
                    <div class="form-check shipping-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="shipping_method" id="jne" value="JNE" form="formCheckout" checked>
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jne">
                            <div>
                                <span class="d-block fw-bold">JNE (Reguler)</span>
                                <small class="text-muted">Estimasi 2-3 hari kerja</small>
                            </div>
                            <span class="fw-bold text-success">Gratis</span>
                        </label>
                    </div>

                    <div class="form-check shipping-option border rounded p-3 mb-3">
                        <input class="form-check-input" type="radio" name="shipping_method" id="jnt" value="J&T" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jnt">
                            <div>
                                <span class="d-block fw-bold">J&T Express</span>
                                <small class="text-muted">Estimasi 1-2 hari kerja</small>
                            </div>
                            <span class="fw-bold">Rp 10.000</span>
                        </label>
                    </div>

                    <div class="form-check shipping-option border rounded p-3">
                        <input class="form-check-input" type="radio" name="shipping_method" id="pickup" value="Ambil di Toko" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="pickup">
                            <div>
                                <span class="d-block fw-bold">Ambil di Toko</span>
                                <small class="text-muted">Bawa bukti pembayaran saat ambil</small>
                            </div>
                            <span class="fw-bold text-success">Gratis</span>
                        </label>
                    </div>
                </div>
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

                </div>

                <div class="mt-4 bg-light p-3 rounded border border-dashed">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Belanja:</span>
                        @php
                        $total = 0;
                        foreach(session('cart') as $details) { $total += $details['harga'] * $details['quantity']; }
                        @endphp
                        <span class="fw-bold" id="baseTotalValue" data-amount="{{ $total }}">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Biaya Pengiriman:</span>
                        <span class="text-success fw-bold" id="shippingFeeText">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between text-primary">
                        <span class="fw-bold">Total Bayar:</span>
                        <h4 class="fw-bold mb-0" id="grandTotalText">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </h4>
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
    .payment-option,
    .shipping-option {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover,
    .shipping-option:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd !important;
    }

    .form-check-input:checked+.form-check-label {
        font-weight: normal;
        /* Menghindari layout shift */
    }

    .form-check-input:checked~label .fw-bold {
        color: #0d6efd;
    }

    .border-dashed {
        border-style: dashed !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Ambil nilai dasar belanja dari atribut data-amount
        const baseTotalElement = document.getElementById('baseTotalValue');
        const baseTotal = parseInt(baseTotalElement.getAttribute('data-amount')) || 0;

        // 2. Ambil elemen yang akan di-update
        const shippingOptions = document.querySelectorAll('input[name="shipping_method"]');
        const shippingFeeText = document.getElementById('shippingFeeText');
        const grandTotalDisplay = document.getElementById('grandTotalText');

        shippingOptions.forEach(option => {
            option.addEventListener('change', (e) => {
                let shippingFee = 0;
                let feeLabel = 'Gratis';
                let isFree = true;

                // 3. Logika Biaya Berdasarkan Pilihan
                if (e.target.value === 'J&T') {
                    shippingFee = 10000;
                    feeLabel = 'Rp 10.000';
                    isFree = false;
                } else {
                    // JNE atau Pickup dianggap Gratis
                    shippingFee = 0;
                    feeLabel = 'Gratis';
                    isFree = true;
                }

                // 4. Kalkulasi Total Akhir
                const finalTotal = baseTotal + shippingFee;

                // 5. Update UI Biaya Pengiriman
                shippingFeeText.innerText = feeLabel;
                if (isFree) {
                    shippingFeeText.className = 'text-success fw-bold';
                } else {
                    shippingFeeText.className = 'text-dark fw-bold';
                }

                // 6. Update UI Grand Total (dengan format ribuan)
                grandTotalDisplay.innerText = 'Rp ' + finalTotal.toLocaleString('id-ID');
            });
        });
    });
</script>
@endsection