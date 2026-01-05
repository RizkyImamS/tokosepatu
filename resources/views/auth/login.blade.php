<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Panel Administrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #224abe;
            --glass-bg: rgba(255, 255, 255, 0.98);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(78, 115, 223, 0.8), rgba(34, 74, 190, 0.9)),
                url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Mencegah background bergeser di mobile */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            z-index: 2;
        }

        .login-card {
            border: none;
            border-radius: 24px;
            background: var(--glass-bg);
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .brand-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin: 0 auto 15px;
            font-size: 30px;
            box-shadow: 0 10px 20px rgba(78, 115, 223, 0.3);
            transform: rotate(-10deg);
        }

        /* --- RESPONSIVE ADJUSTMENTS --- */

        /* Tablet (iPad) */
        @media (max-width: 768px) {
            .login-card {
                padding: 35px 30px;
            }
        }

        /* Handphone (Mobile) */
        @media (max-width: 480px) {
            body {
                padding: 15px;
                align-items: flex-start;
                /* Card mulai dari atas jika layar sangat pendek */
                padding-top: 50px;
            }

            .login-card {
                padding: 30px 20px;
                border-radius: 20px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                font-size: 25px;
            }

            h3 {
                font-size: 1.5rem;
            }

            .btn-login {
                padding: 12px;
                font-size: 0.9rem;
            }
        }

        /* Handling Landscape Mobile */
        @media (max-height: 500px) {
            body {
                align-items: flex-start;
                padding-top: 20px;
            }

            .login-card {
                margin-bottom: 20px;
            }
        }

        /* Element Styling */
        .input-group-text {
            background-color: #f8f9fc;
            border: 1px solid #d1d3e2;
            color: #4e73df;
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            border-radius: 0 12px 12px 0;
            padding: 12px 15px;
            border: 1px solid #d1d3e2;
            font-size: 16px !important;
            /* Mencegah auto-zoom di iOS Safari */
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #858796;
            padding: 10px;
            /* Memperluas area klik di HP */
        }

        .btn-login {
            background: linear-gradient(45deg, var(--primary-color), #6a89cc);
            border: none;
            color: white;
            border-radius: 14px;
            padding: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(78, 115, 223, 0.5);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px rgba(78, 115, 223, 0.4);
        }

        /* Efek Kilauan (Glow) saat di-hover */
        .btn-login::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover::after {
            left: 100%;
        }

        .back-link {
            color: #858796;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--primary-dark);
        }
    </style>
</head>

<body>

    <div class="login-container animate__animated animate__fadeIn">
        <div class="login-card">
            <div class="text-center">
                <div class="brand-logo">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">SuperShoe</h3>
                <p class="text-muted small mb-4">Administrasi Panel</p>
            </div>

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control"
                            placeholder="admin@supershoe.id" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="passwordInput" class="form-control"
                            placeholder="••••••••" required>
                        <span class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="small text-decoration-none">Lupa Password?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        <span>Masuk Sekarang</span>
                        <i class="fas fa-chevron-right small animate__animated animate__fadeInRight animate__infinite animate__slow"></i>
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="back-link">
                    <i class="fas fa-house me-1"></i> Ke Beranda
                </a>
            </div>
        </div>

        <div class="text-center mt-4 text-white small" style="opacity: 0.7;">
            &copy; 2026 SuperShoe Tech
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>