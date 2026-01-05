<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Admin - Latihan Magang</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            transition: all 0.3s;
        }

        .nav-item.active .nav-link {
            font-weight: bold;
            background: rgba(255, 255, 255, 0.1);
        }

        .topbar {
            border-bottom: 1px solid #e3e6f0;
        }

        .card {
            border-radius: 12px;
            border: none;
        }

        .btn {
            border-radius: 8px;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #4e73df;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2e59d9;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="{{ url('/admin/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SuperShoe</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Inventory & Sales</div>

            <li class="nav-item {{ request()->is('admin/sepatu*') || request()->is('admin/kategori*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('admin/sepatu*') || request()->is('admin/kategori*') ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseSepatu"
                    aria-expanded="true" aria-controls="collapseSepatu">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Katalog Produk</span>
                </a>
                <div id="collapseSepatu" class="collapse {{ request()->is('admin/sepatu*') || request()->is('admin/kategori*') ? 'show' : '' }}"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('sepatu.index') ? 'active' : '' }}" href="{{ route('sepatu.index') }}">Daftar Sepatu</a>
                        <a class="collapse-item {{ request()->routeIs('sepatu.create') ? 'active' : '' }}" href="{{ route('sepatu.create') }}">Tambah Produk</a>
                        <a class="collapse-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">Data Kategori</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->is('admin/riwayat*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('riwayat.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Pesanan Masuk</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pengaturan</div>

            <li class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Kelola User</span></a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link fw-bold" href="javascript:void(0)" onclick="logoutSistem()">
                    <i class="fas fa-fw fa-power-off"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <h5 class="d-none d-lg-inline text-gray-800 font-weight-bold ml-2">Sistem Management Toko Sepatu</h5>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="text-right mr-3 d-none d-lg-block">
                                    <span class="d-block text-gray-600 small font-weight-bold">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">Administrator</small>
                                </div>
                                <img class="img-profile rounded-circle shadow-sm" src="{{ asset('template/img/undraw_profile.svg') }}">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            <footer class="sticky-footer bg-white mt-5">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Latihan Magang &copy; 2026 | Built with <i class="fas fa-heart text-danger"></i></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert untuk Logout
        function logoutSistem() {
            Swal.fire({
                title: 'Sudah selesai bekerja?',
                text: "Anda akan keluar dari sesi admin.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }

        // Handle AJAX Tambah User
        $(document).ready(function() {
            $('#formTambahUser').on('submit', function(e) {
                e.preventDefault();
                let btn = $('#btnSimpanUser');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');

                $.ajax({
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#modalTambahUser').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Admin baru telah ditambahkan.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).text('Simpan User');
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul class="text-left">';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                        errorHtml += '</ul>';

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            html: errorHtml
                        });
                    }
                });
            });

            // Auto hide alert
            $(".alert").delay(4000).slideUp(500, function() {
                $(this).remove();
            });
        });
    </script>

</body>

</html>