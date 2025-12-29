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

        .btn-admin {
            background-color: #333;
            color: white !important;
            border-radius: 8px;
            padding: 8px 20px !important;
            transition: all 0.3s;
        }

        .btn-admin:hover {
            background-color: #000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
                            Kategori
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
                                <a class="dropdown-item fw-bold text-primary" href="{{ url('/') }}">
                                    Semua Produk
                                </a>
                            </li>
                        </ul>
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
                        <a class="nav-link btn-admin" href="{{ route('sepatu.index') }}">
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
                        <li class="mb-2"><a href="#" class="footer-link">Semua Produk</a></li>
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
            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                let button = $(this);

                button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: "{{ url('/cart/add') }}/" + id,
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i>');

                        // Update Badge Navbar
                        if ($('.badge.rounded-pill.bg-danger').length) {
                            $('.badge.rounded-pill.bg-danger').text(response.cart_count);
                        } else {
                            $('.nav-link.position-relative').append('<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">' + response.cart_count + '</span>');
                        }

                        // SweetAlert2 Toast (Muncul di pojok kanan atas)
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Sepatu telah ditambahkan ke keranjang.'
                        });
                    },
                    error: function() {
                        button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i>');

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menambah produk.',
                            confirmButtonColor: '#0d6efd'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-remove-cart').click(function(e) {
                let id = $(this).data('id');
                let row = $(this).closest('tr'); // Ambil baris tabelnya

                Swal.fire({
                    title: 'Hapus item?',
                    text: "Sepatu ini akan dikeluarkan dari keranjang.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
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
                                // Hilangkan baris tabel dengan animasi
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                    // Jika keranjang kosong setelah dihapus, refresh halaman untuk tampilkan pesan 'Kosong'
                                    if ($('tbody tr').length == 0) {
                                        location.reload();
                                    }
                                });

                                // Update angka di navbar
                                $('.badge.rounded-pill.bg-danger').text(response.cart_count);

                                Swal.fire(
                                    'Dihapus!',
                                    'Produk telah dihapus dari keranjang.',
                                    'success'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $('#formCheckout').on('submit', function(e) {
            e.preventDefault();

            const btn = $(this).find('button[type="submit"]');
            const originalText = btn.html();

            // Validasi input
            if ($('input[name="customer_name"]').val() == "" || $('input[name="phone"]').val() == "" || $('textarea[name="address"]').val() == "") {
                alert('Harap isi semua informasi pengiriman');
                return;
            }

            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

            $.ajax({
                url: "{{ route('cart.proses') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.snap_token) {
                        // MEMANGGIL MODAL MIDTRANS
                        window.snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                // Pembayaran Berhasil
                                window.location.href = "{{ url('/order/success') }}?order_id=" + result.order_id;
                            },
                            onPending: function(result) {
                                // Pembayaran Menunggu (User menutup snap sebelum bayar / pilih e-wallet tapi belum scan)
                                window.location.href = "{{ url('/order/pending') }}/" + result.order_id;
                            },
                            onError: function(result) {
                                // Pembayaran Error
                                alert("Terjadi kesalahan pada sistem pembayaran.");
                                btn.prop('disabled', false).html(originalText);
                            },
                            onClose: function() {
                                // User menutup popup modal tanpa bayar
                                alert('Anda menutup jendela tanpa menyelesaikan pembayaran.');
                                btn.prop('disabled', false).html(originalText);
                            }
                        });
                    } else if (response.error) {
                        alert(response.error);
                        btn.prop('disabled', false).html(originalText);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Gagal terhubung ke server. Pastikan Server Key Midtrans sudah benar.');
                    btn.prop('disabled', false).html(originalText);
                }
            });
        });
    </script>
</body>

</html>