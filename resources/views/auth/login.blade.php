<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Login - Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow: hidden;
            background: #1a0a0a;
        }

        /* ── Animated Background ── */
        .login-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Left Panel - Branding */
        .brand-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #4a0e0e 0%, #7a1a1a 30%, #a01e2e 60%, #6e1623 100%);
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(160, 30, 46, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(220, 38, 38, 0.2) 0%, transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(113, 14, 28, 0.3) 0%, transparent 45%);
            animation: bgPulse 8s ease-in-out infinite;
        }

        @keyframes bgPulse {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.05) rotate(2deg);
                opacity: 0.8;
            }
        }

        /* Floating particles */
        .particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: floatUp linear infinite;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-10vh) scale(1);
                opacity: 0;
            }
        }

        .brand-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 480px;
        }

        .brand-logo {
            width: 130px;
            height: 130px;
            object-fit: contain;
            margin-bottom: 2rem;
            filter: drop-shadow(0 8px 32px rgba(0, 0, 0, 0.3));
            animation: logoFloat 4s ease-in-out infinite;
        }

        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.4;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .brand-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            font-weight: 400;
        }

        .brand-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.75rem 1.25rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(4px);
        }

        .feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .feature-icon.blue {
            background: rgba(220, 38, 38, 0.25);
            color: #fca5a5;
        }

        .feature-icon.green {
            background: rgba(34, 197, 94, 0.25);
            color: #86efac;
        }

        .feature-icon.amber {
            background: rgba(245, 158, 11, 0.25);
            color: #fcd34d;
        }

        .feature-text {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        /* Right Panel - Login Form */
        .form-panel {
            width: 520px;
            min-width: 420px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background: #ffffff;
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 380px;
            animation: fadeSlideUp 0.6s ease-out;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
            letter-spacing: -0.03em;
        }

        .form-header p {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 0.875rem 0.8rem 2.75rem;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: #111827;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-input:focus {
            border-color: #a01e2e;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(160, 30, 46, 0.1);
        }

        .form-input:focus~.input-icon,
        .form-input:focus+.input-icon {
            color: #a01e2e;
        }

        .input-wrapper:focus-within .input-icon {
            color: #a01e2e;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            font-size: 1.1rem;
            padding: 4px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #a01e2e;
        }

        /* Checkbox */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #a01e2e;
            border-radius: 4px;
            cursor: pointer;
        }

        .checkbox-wrapper span {
            font-size: 0.85rem;
            color: #6b7280;
            user-select: none;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #a01e2e;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #6e1623;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 0.85rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #ffffff;
            background: linear-gradient(135deg, #a01e2e, #6e1623);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.02em;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #dc2626, #a01e2e);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(160, 30, 46, 0.35);
        }

        .btn-login:hover::before {
            opacity: 1;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login span {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Alert */
        .alert-error {
            padding: 0.75rem 1rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #dc2626;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: shakeX 0.5s ease;
        }

        @keyframes shakeX {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-6px);
            }

            40% {
                transform: translateX(6px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        /* Footer */
        .form-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.8rem;
            color: #9ca3af;
        }

        /* ── Responsive ── */
        @media (max-width: 1000px) {
            .login-wrapper {
                flex-direction: column;
            }

            .brand-panel {
                padding: 2rem 1.5rem;
                min-height: auto;
            }

            .brand-logo {
                width: 80px;
                height: 80px;
                margin-bottom: 1rem;
            }

            .brand-title {
                font-size: 1.15rem;
            }

            .brand-features {
                display: block;
            }

            .feature-item {
                margin: 10px;
            }

            .form-panel {
                width: 100%;
                min-width: unset;
                flex: 1;
                padding: 2rem 1.5rem;
            }
        }

        /* Decorative corner shapes on brand panel */
        .corner-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            pointer-events: none;
        }

        .corner-shape.top-right {
            top: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
        }

        .corner-shape.bottom-left {
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <!-- Left Branding Panel -->
        <div class="brand-panel">
            <div class="corner-shape top-right"></div>
            <div class="corner-shape bottom-left"></div>

            <!-- Floating Particles -->
            <div class="particles" id="particles"></div>

            <div class="brand-content">
                <img src="{{ asset('img/logo_dinas_no_title.png') }}" alt="Logo Kabupaten Badung" class="brand-logo">
                <h1 class="brand-title">Sistem Informasi Sertifikasi</h1>
                <p class="brand-subtitle">Dinas Perindustrian dan Ketenagakerjaan<br>Kabupaten Badung</p>

                <div class="brand-features">

                    <a href="/pegawai" style="text-decoration: none">
                        <div class="feature-item">
                            <div class="feature-icon green">
                                <i class="bi bi-people"></i>
                            </div>
                            <span class="feature-text">Pendataan Jumlah Pegawai Hotel</span>
                        </div>
                    </a>

                    <a href="/asesi" style="text-decoration: none">
                        <div class="feature-item">
                            <div class="feature-icon amber">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <span class="feature-text">Pendaftaran Calon Asesi</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Login Form Panel -->
        <div class="form-panel">
            <div class="form-container">
                <div class="form-header">
                    <h2>Selamat Datang 👋</h2>
                    <p>Silakan masuk dengan akun Anda untuk melanjutkan.</p>
                </div>

                @error('login')
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="login-email">Email / Username</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input
                                class="form-input"
                                type="text"
                                name="login"
                                id="login-email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="Masukkan email atau username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input
                                class="form-input"
                                type="password"
                                name="password"
                                id="login-password"
                                required
                                placeholder="Masukkan password">
                            <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="checkbox-signin">
                            <span>Ingat saya</span>
                        </label>
                        {{-- <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a> --}}
                    </div>

                    <button class="btn-login" type="submit" id="btn-submit">
                        <span>
                            <i class="bi bi-box-arrow-in-right"></i>
                            Masuk
                        </span>
                    </button>
                </form>

                <div class="form-footer">
                    &copy; {{ date('Y') }} Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung
                </div>
            </div>
        </div>
    </div>

    <script>
        // ── Password Toggle ──
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('login-password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        }

        // ── Floating Particles ──
        (function() {
            const container = document.getElementById('particles');
            if (!container) return;
            const count = 25;
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                p.style.left = Math.random() * 100 + '%';
                p.style.width = p.style.height = (Math.random() * 4 + 2) + 'px';
                p.style.animationDuration = (Math.random() * 8 + 6) + 's';
                p.style.animationDelay = (Math.random() * 6) + 's';
                container.appendChild(p);
            }
        })();
    </script>
</body>

</html>
