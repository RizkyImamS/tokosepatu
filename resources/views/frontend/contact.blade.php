@extends('frontend.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <h1 class="fw-bold mb-4">Hubungi Kami</h1>
            <p class="text-muted mb-5">Punya pertanyaan seputar produk atau pesanan? Tim kami siap membantu Anda setiap hari kerja.</p>

            <div class="d-flex mb-4">
                <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Alamat Kantor</h6>
                    <p class="text-muted">{{ $konfigurasi->alamat ?? 'Jl. Raya Sepatu No. 123, Jakarta' }}</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Telepon / WhatsApp</h6>
                    <p class="text-muted">{{ $konfigurasi->no_telp ?? '+62 812 3456 7890' }}</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Email Dukungan</h6>
                    <p class="text-muted">{{ $konfigurasi->email ?? 'support@sepatustore.com' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light border-0 py-3" placeholder="Masukkan nama...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control bg-light border-0 py-3" placeholder="Masukkan email...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Subjek</label>
                            <input type="text" class="form-control bg-light border-0 py-3" placeholder="Apa yang ingin ditanyakan?">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Pesan</label>
                            <textarea class="form-control bg-light border-0 py-3" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill">Kirim Pesan Sekarang</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection