<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ShoeStore - Koleksi Sepatu Terbaik')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            transition: all 0.3s;
        }

        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .navbar-brand span {
            color: #0d6efd;
            /* Warna Biru Produk */
        }

        .nav-link {
            font-weight: 500;
            color: #444 !important;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #0d6efd !important;
        }

        /* Revamped Login Button Styling */
        .btn-login {
            background-color: transparent;
            color: #0d6efd !important;
            /* Warna Biru Utama */
            border: 2px solid #0d6efd;
            border-radius: 50px;
            /* Membuat lonjong sempurna */
            padding: 8px 24px !important;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login i {
            font-size: 0.85rem;
            transition: transform 0.3s;
        }

        .btn-login:hover {
            background-color: #0d6efd;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.25);
        }

        .btn-login:hover i {
            transform: translateX(2px);
            /* Efek ikon sedikit bergeser saat hover */
        }

        /* Opsional: Jika ingin gaya yang lebih 'Bold' seperti tombol hitam sebelumnya tapi lebih smooth */
        .btn-admin-dark {
            background: #222;
            color: #fff !important;
            border-radius: 12px;
            padding: 10px 25px !important;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .btn-admin-dark:hover {
            background: #000;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        /* Footer Styling */
        footer {
            background: #111;
            color: #999;
            padding: 70px 0 30px;
        }

        .footer-logo {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: block;
            text-decoration: none;
        }

        .footer-logo span {
            color: #0d6efd;
        }

        .footer-link {
            color: #999;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: white;
            padding-left: 8px;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: white;
            margin-right: 10px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            background: #0d6efd;
            transform: translateY(-5px);
            color: white;
        }

        /* Hero & Section Utils */
        .section-padding {
            padding: 60px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-bolt me-2 text-primary"></i>SHOE<span>STORE</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'text-primary' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk
                        </a>
                        <ul class="dropdown-menu border-0 shadow animate__animated animate__fadeInUp" aria-labelledby="navbarDropdown">
                            @forelse($kategoriSepatu as $kat)
                            <li>
                                <a class="dropdown-item" href="{{ url('/kategori/'.$kat->id) }}">
                                    {{ $kat->nama_kategori }}
                                </a>
                            </li>
                            @empty
                            <li><a class="dropdown-item disabled" href="#">Tidak ada kategori</a></li>
                            @endforelse
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold text-primary" href="{{ url('/list-sepatu') }}">
                                    Semua Produk
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'text-primary' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'text-primary' : '' }}" href="{{ route('contact') }}">Kontak</a>
                    </li>

                    <li class="nav-item mx-1">
                        <a class="nav-link position-relative" href="{{ route('wishlist.index') }}">
                            <i class="fas fa-heart fa-lg text-danger"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishlist-badge">
                                {{ session()->get('wishlist') ? count(session()->get('wishlist')) : 0 }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                {{ count(session('cart')) }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-login" href="{{ route('sepatu.index') }}">
                            <i class="fas fa-lock me-1"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a class="footer-logo" href="#">SHOE<span>STORE</span></a>
                    <p>Destinasi utama untuk para pencinta sepatu. Kami menyediakan koleksi terbaik dari brand ternama dengan kualitas yang terjamin original.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h5 class="text-white fw-bold mb-4">Belanja</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#produk" class="footer-link">Semua Produk</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Cara Order</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Konfirmasi Bayar</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h5 class="text-white fw-bold mb-4">Layanan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Kontak Kami</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Kebijakan Retur</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="text-white fw-bold mb-4">Newsletter</h5>
                    <p class="small">Dapatkan info promo dan rilis sepatu terbaru setiap minggu.</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control border-0" placeholder="Email Anda">
                        <button class="btn btn-primary" type="button">Daftar</button>
                    </div>
                </div>
            </div>
            <hr class="my-5 opacity-25">
            <div class="text-center">
                <p class="small mb-0">&copy; 2025 ShoeStore - Langkah Pasti Gaya Berkelas. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        $(document).ready(function() {
            // Pengaturan Dasar SweetAlert Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-start',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });

            // --- 1. TAMBAH KE KERANJANG ---
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let ukuran = $('input[name="ukuran"]:checked').val();
                let button = $(this);
                let originalHtml = button.html();

                // Validasi jika input ukuran ada tapi belum dipilih
                if ($('input[name="ukuran"]').length > 0 && !ukuran) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Pilih ukuran dulu!'
                    });
                    return;
                }

                button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: "{{ url('/cart/add') }}/" + id,
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        ukuran: ukuran
                    },
                    success: function(response) {
                        button.prop('disabled', false).html(originalHtml);

                        // Update Badge Keranjang secara dinamis
                        let cartBadge = $('.fa-shopping-cart').parent().find('.badge');
                        if (cartBadge.length) {
                            cartBadge.text(response.cart_count).hide().fadeIn();
                        } else {
                            $('.fa-shopping-cart').parent().append(`<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">${response.cart_count}</span>`);
                        }

                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Produk masuk keranjang.'
                        });
                    },
                    error: function() {
                        button.prop('disabled', false).html(originalHtml);
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal menambahkan produk.'
                        });
                    }
                });
            });

            // --- 2. HAPUS DARI KERANJANG (Halaman Cart) ---
            $(document).on('click', '.btn-remove-cart', function(e) {
                let id = $(this).data('id');
                let row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus item?',
                    text: "Sepatu akan dikeluarkan dari keranjang.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/cart/remove') }}/" + id,
                            method: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                    if ($('tbody tr').length == 0) location.reload();
                                });
                                $('.badge.rounded-pill.bg-danger').text(response.cart_count);
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Terhapus dari keranjang'
                                });
                            }
                        });
                    }
                });
            });

            // --- 3. TOGGLE WISHLIST (Tambah/Hapus) ---
            $(document).on('click', '.btn-wishlist', function(e) {
                e.preventDefault();
                let btn = $(this);
                let icon = btn.find('i');
                let sepatuId = btn.data('id');

                btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('wishlist.toggle') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        sepatu_id: sepatuId
                    },
                    success: function(response) {
                        btn.prop('disabled', false);
                        $('.wishlist-badge').text(response.wishlist_count).hide().fadeIn();

                        if (response.status === 'added') {
                            btn.removeClass('btn-outline-dark').addClass('btn-danger text-white');
                            icon.removeClass('far').addClass('fas');
                            Toast.fire({
                                icon: 'success',
                                title: 'Ditambah ke Wishlist'
                            });
                        } else {
                            btn.removeClass('btn-danger text-white').addClass('btn-outline-dark');
                            icon.removeClass('fas').addClass('far');
                            Toast.fire({
                                icon: 'info',
                                title: 'Dihapus dari Wishlist'
                            });
                        }
                    }
                });
            });

            // --- 4. CHECKOUT PROSES ---
            $('#formCheckout').on('submit', function(e) {
                e.preventDefault();
                const btn = $(this).find('button[type="submit"]');
                const originalText = btn.html();

                // Validasi Sederhana
                if (!$('input[name="customer_name"]').val() || !$('input[name="phone"]').val()) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Data belum lengkap!'
                    });
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

                $.ajax({
                    url: "{{ route('cart.proses') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.snap_token) {
                            window.snap.pay(response.snap_token, {
                                onSuccess: function(result) {
                                    window.location.href = "{{ url('/order/success') }}?order_id=" + result.order_id;
                                },
                                onPending: function(result) {
                                    window.location.href = "{{ url('/order/pending') }}/" + result.order_id;
                                },
                                onError: function() {
                                    btn.prop('disabled', false).html(originalText);
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Pembayaran Gagal'
                                    });
                                },
                                onClose: function() {
                                    btn.prop('disabled', false).html(originalText);
                                    Toast.fire({
                                        icon: 'info',
                                        title: 'Pembayaran Dibatalkan'
                                    });
                                }
                            });
                        } else if (response.error) {
                            btn.prop('disabled', false).html(originalText);
                            Swal.fire('Gagal', response.error, 'error');
                        }
                    },
                    error: function() {
                        btn.prop('disabled', false).html(originalText);
                        Toast.fire({
                            icon: 'error',
                            title: 'Koneksi Server Gagal'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>