@extends('frontend.layout')

@section('content')
<style>
    /* Hero Hubungi Kami */
    .contact-header {
        background: linear-gradient(135deg, #0d6efd 0%, #000000 100%);
        padding: 80px 0;
        color: white;
        border-radius: 0 0 50px 50px;
        margin-bottom: -50px;
    }

    .info-card {
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        border-color: #0d6efd;
    }

    .map-container {
        border-radius: 20px;
        overflow: hidden;
        filter: grayscale(10%);
        transition: 0.5s;
    }

    .map-container:hover {
        filter: grayscale(0%);
    }

    .faq-section {
        background-color: #f8f9fa;
        border-radius: 30px;
        padding: 60px 0;
    }

    .accordion-item {
        border: none;
        margin-bottom: 15px;
        border-radius: 15px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(13, 110, 253, 0.05);
        color: #0d6efd;
    }
</style>

<div class="contact-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold animate__animated animate__fadeIn">Ada yang Bisa Kami Bantu?</h1>
        <p class="opacity-75">Kami senang mendengar kabar dari Anda. Silakan hubungi kami melalui formulir atau kontak di bawah.</p>
    </div>
</div>

<div class="container" style="position: relative; z-index: 10;">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card info-card h-100 border-0 shadow-sm p-4 rounded-4">
                <div class="bg-primary text-white rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h5 class="fw-bold">Alamat Kantor</h5>
                <p class="text-muted small mb-0">{{ $konfigurasi->alamat ?? 'Jl. Raya Sepatu No. 123, Jakarta Selatan, Indonesia 12345' }}</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card info-card h-100 border-0 shadow-sm p-4 rounded-4">
                <div class="bg-success text-white rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h5 class="fw-bold">WhatsApp Admin</h5>
                <p class="text-muted small mb-0">{{ $konfigurasi->no_telp ?? '+62 812 3456 7890' }}</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $konfigurasi->no_telp ?? '6281234567890') }}" class="small text-decoration-none mt-2 d-inline-block">Chat Sekarang &rarr;</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card info-card h-100 border-0 shadow-sm p-4 rounded-4">
                <div class="bg-info text-white rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5 class="fw-bold">Email Dukungan</h5>
                <p class="text-muted small mb-0">{{ $konfigurasi->email ?? 'support@supershoe.id' }}</p>
            </div>
        </div>

        <div class="col-lg-7 mt-5">
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4">
                <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                <form action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light border-0 py-3" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Alamat Email</label>
                            <input type="email" class="form-control bg-light border-0 py-3" placeholder="email@anda.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Subjek</label>
                            <select class="form-select bg-light border-0 py-3">
                                <option selected>Tanya Stok Produk</option>
                                <option>Status Pengiriman</option>
                                <option>Keluhan / Komplain</option>
                                <option>Kerjasama Business</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Pesan Anda</label>
                            <textarea class="form-control bg-light border-0 py-3" rows="4" placeholder="Tuliskan detail pertanyaan Anda..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow">Kirim Pesan Sekarang <i class="fas fa-paper-plane ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5 mt-5">
            <h4 class="fw-bold mb-3">Lokasi Showroom</h4>
            <div class="map-container shadow-sm mb-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.257523275217!2d106.81881577484462!3d-6.229746493758414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e4a9562729%3A0x6649477660635412!2sSCBD!5e0!3m2!1sid!2sid!4v1715671234567!5m2!1sid!2sid"
                    width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="p-3 bg-light rounded-4">
                <h6 class="fw-bold"><i class="fas fa-clock text-primary me-2"></i> Jam Operasional</h6>
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="d-flex justify-content-between"><span>Senin - Jumat:</span> <span>09:00 - 18:00</span></li>
                    <li class="d-flex justify-content-between border-top pt-1 mt-1"><span>Sabtu:</span> <span>10:00 - 15:00</span></li>
                    <li class="d-flex justify-content-between border-top pt-1 mt-1 text-danger"><span>Minggu / Tgl Merah:</span> <span>Tutup</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="faq-section mt-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pertanyaan Umum (FAQ)</h2>
            <p class="text-muted">Mungkin jawaban yang Anda cari sudah ada di sini.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah semua produk di sini original?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Ya, kami menjamin 100% keaslian semua produk yang kami jual. Kami bekerja sama langsung dengan distributor resmi brand ternama.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Bagaimana jika ukuran sepatu tidak pas?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Anda dapat melakukan penukaran ukuran (size) maksimal 3 hari setelah produk diterima, selama label belum dilepas dan sepatu belum digunakan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Berapa lama proses pengiriman?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Untuk wilayah Jabodetabek biasanya 1-2 hari kerja. Luar pulau Jawa berkisar antara 3-7 hari kerja tergantung ekspedisi yang dipilih.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 text-center">
    <h5 class="fw-bold mb-4">Ikuti Kami di Media Sosial</h5>
    <div class="d-flex justify-content-center gap-3">
        <a href="#" class="btn btn-outline-primary rounded-circle p-3" style="width: 55px; height: 55px;"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="#" class="btn btn-outline-primary rounded-circle p-3" style="width: 55px; height: 55px;"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a href="#" class="btn btn-outline-primary rounded-circle p-3" style="width: 55px; height: 55px;"><i class="fab fa-tiktok fa-lg"></i></a>
        <a href="#" class="btn btn-outline-primary rounded-circle p-3" style="width: 55px; height: 55px;"><i class="fab fa-youtube fa-lg"></i></a>
    </div>
</div>

@endsection