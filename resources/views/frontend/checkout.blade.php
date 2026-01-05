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
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="customer_name" class="form-control shadow-none" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="address" class="form-control shadow-none" rows="3" required placeholder="Jalan, No Rumah, Kelurahan, Kecamatan..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor WhatsApp</label>
                        <input type="number" name="phone" class="form-control shadow-none" required placeholder="081234567xxx">
                    </div>
                </form>
            </div>

            <h4 class="fw-bold mb-4">Metode Pengiriman</h4>
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="shipping-methods">
                    <div class="form-check shipping-option border rounded p-3 mb-3">
                        <input class="form-check-input shadow-none" type="radio" name="shipping_method" id="jne" value="JNE" form="formCheckout" checked>
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jne">
                            <div>
                                <span class="d-block fw-bold text-dark">JNE (Reguler)</span>
                                <small class="text-muted">Estimasi 2-3 hari kerja</small>
                            </div>
                            <span class="fw-bold text-success">Gratis</span>
                        </label>
                    </div>

                    <div class="form-check shipping-option border rounded p-3 mb-3">
                        <input class="form-check-input shadow-none" type="radio" name="shipping_method" id="jnt" value="J&T" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jnt">
                            <div>
                                <span class="d-block fw-bold text-dark">J&T Express</span>
                                <small class="text-muted">Estimasi 1-2 hari kerja</small>
                            </div>
                            <span class="fw-bold">Rp 10.000</span>
                        </label>
                    </div>

                    <div class="form-check shipping-option border rounded p-3">
                        <input class="form-check-input shadow-none" type="radio" name="shipping_method" id="pickup" value="Ambil di Toko" form="formCheckout">
                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="pickup">
                            <div>
                                <span class="d-block fw-bold text-dark">Ambil di Toko</span>
                                <small class="text-muted">Gratis biaya parkir & aman</small>
                            </div>
                            <span class="fw-bold text-success">Gratis</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="checkout-sticky">
                <h4 class="fw-bold mb-4">Ringkasan Pesanan</h4>
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="order-items-container p-4" style="max-height: 300px; overflow-y: auto;">
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <div class="d-flex align-items-center {{ !$loop->last ? 'mb-4' : '' }}">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $details['gambar']) }}" class="rounded border" style="width: 60px; height: 60px; object-fit: cover;">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 0.65rem;">
                                    {{ $details['quantity'] }}
                                </span>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <h6 class="mb-0 fw-bold small text-truncate" style="max-width: 150px;">{{ $details['nama'] }}</h6>
                                <small class="text-muted d-block">Size: {{ $details['ukuran'] ?? '-' }}</small>
                            </div>
                            <div class="text-end">
                                <span class="fw-bold small text-nowrap">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="p-4 pt-0 border-top bg-white">
                        <div class="py-3">
                            <label class="form-label small fw-bold">Punya Kode Promo?</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="couponCode" class="form-control shadow-none" placeholder="Masukkan kode...">
                                <button class="btn btn-dark" type="button" id="btnApplyVoucher">Pakai</button>
                            </div>
                            <div id="voucherMessage" class="small mt-1"></div>
                        </div>

                        <div class="billing-details bg-light p-3 rounded-3 mb-3">
                            @php
                            $subtotal = 0;
                            if(session('cart')) {
                            foreach(session('cart') as $d) { $subtotal += $d['harga'] * $d['quantity']; }
                            }
                            @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Subtotal</span>
                                <span class="small fw-semibold" id="displaySubtotal" data-value="{{ $subtotal }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Ongkos Kirim</span>
                                <span id="shippingFeeText" class="text-success small fw-bold">Gratis</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 d-none" id="promoRow">
                                <span class="text-muted small">Diskon Promo</span>
                                <span class="text-danger small fw-bold" id="promoAmount">- Rp 0</span>
                            </div>
                            <hr class="my-2 opacity-50">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total Bayar</span>
                                <h4 class="fw-bold text-primary mb-0" id="grandTotalText">Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>
                            </div>
                        </div>

                        <button type="submit" form="formCheckout" class="btn btn-primary w-100 btn-lg rounded-3 shadow-sm py-3 mb-2">
                            Bayar Sekarang
                        </button>

                        <div class="text-center py-2">
                            <small class="text-muted"><i class="fas fa-lock me-1"></i> Pembayaran Aman & Terenkripsi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Sticky Fix */
    @media (min-width: 768px) {
        .checkout-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 2rem;
            /* Jarak dari atas saat scroll */
            z-index: 1000;
        }
    }

    /* Custom Scrollbar untuk Daftar Item */
    .order-items-container::-webkit-scrollbar {
        width: 4px;
    }

    .order-items-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .order-items-container::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .shipping-option {
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        border: 2px solid #dee2e6 !important;
    }

    .shipping-option:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd !important;
    }

    /* Highlight pilihan yang aktif */
    input[name="shipping_method"]:checked+label {
        color: #0d6efd !important;
    }

    .form-check-input:checked~.form-check-label .fw-bold {
        color: #0d6efd !important;
    }

    .shipping-option:has(.form-check-input:checked) {
        border-color: #0d6efd !important;
        background-color: #f0f7ff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subtotal = parseInt(document.getElementById('displaySubtotal').getAttribute('data-value')) || 0;
        const shippingOptions = document.querySelectorAll('input[name="shipping_method"]');
        const shippingFeeText = document.getElementById('shippingFeeText');
        const grandTotalText = document.getElementById('grandTotalText');

        let currentShipping = 0;
        let currentDiscount = 0;

        function updateTotal() {
            const finalTotal = (subtotal + currentShipping) - currentDiscount;
            grandTotalText.innerText = 'Rp ' + finalTotal.toLocaleString('id-ID');
        }

        shippingOptions.forEach(option => {
            option.addEventListener('change', (e) => {
                if (e.target.value === 'J&T') {
                    currentShipping = 10000;
                    shippingFeeText.innerText = 'Rp 10.000';
                    shippingFeeText.className = 'text-dark small fw-bold';
                } else {
                    currentShipping = 0;
                    shippingFeeText.innerText = 'Gratis';
                    shippingFeeText.className = 'text-success small fw-bold';
                }
                updateTotal();
            });
        });

        document.getElementById('btnApplyVoucher').addEventListener('click', function() {
            const code = document.getElementById('couponCode').value.toUpperCase();
            const msg = document.getElementById('voucherMessage');
            const promoRow = document.getElementById('promoRow');
            const promoAmount = document.getElementById('promoAmount');

            if (code === 'DISKONBARU') {
                currentDiscount = 20000;
                msg.innerHTML = '<span class="text-success small"><i class="fas fa-check-circle"></i> Voucher berhasil!</span>';
                promoRow.classList.remove('d-none');
                promoAmount.innerText = '- Rp ' + currentDiscount.toLocaleString('id-ID');
                this.classList.replace('btn-dark', 'btn-success');
                this.innerText = 'OK';
            } else if (code === 'DISKONAJA') {
                currentDiscount = 15000;
                msg.innerHTML = '<span class="text-success small"><i class="fas fa-check-circle"></i> Voucher berhasil!</span>';
                promoRow.classList.remove('d-none');
                promoAmount.innerText = '- Rp ' + currentDiscount.toLocaleString('id-ID');
                this.classList.replace('btn-dark', 'btn-success');
                this.innerText = 'OK';
            } else {
                currentDiscount = 0;
                msg.innerHTML = '<span class="text-danger small"><i class="fas fa-times-circle"></i> Kode tidak valid</span>';
                promoRow.classList.add('d-none');
                this.classList.replace('btn-success', 'btn-dark');
                this.innerText = 'Pakai';
            }
            updateTotal();
        });
    });
</script>
@endsection