<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin SD Negeri 7 Bangsri</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #a7f3d0 0%, #10b981 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .login-left .logo {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .login-left h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #1a5c3d;
        }

        .login-left p {
            font-size: 1.1rem;
            color: #2d3748;
            line-height: 1.6;
        }

        .login-right {
            flex: 1;
            padding: 3rem;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h2 {
            font-size: 2rem;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #718096;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2d3748;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f7fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.is-invalid {
            border-color: #f56565;
            background: #fff5f5;
        }

        .invalid-feedback {
            color: #f56565;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-weight: normal;
            color: #4a5568;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .forgot-link {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-link a {
            color: #f56565;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .forgot-link a:hover {
            color: #c53030;
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: #fff5f5;
            border-left: 4px solid #f56565;
            color: #c53030;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                padding: 2rem;
            }

            .login-left h1 {
                font-size: 1.5rem;
            }

            .login-left p {
                font-size: 1rem;
            }

            .login-right {
                padding: 2rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }

        /* Loading state */
        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .loading {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Input icons */
        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 1.2rem;
        }

        .input-wrapper .form-control {
            padding-left: 3rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Branding -->
        <div class="login-left">
            <div class="logo">🎓</div>
            <h1>SD Negeri 7 Bangsri</h1>
            <p>Sistem Informasi Manajemen Sekolah</p>
            <p style="margin-top: 1.5rem; font-size: 0.9rem;">Admin Panel untuk mengelola konten website sekolah</p>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Selamat Datang! 👋</h2>
                <p>Silakan login untuk mengakses dashboard admin</p>
            </div>

            <!-- Error Messages -->
            @if (session('status'))
            <div class="alert alert-success" style="background: #f0fff4; border-left: 4px solid #48bb78; color: #276749;">
                ✅ {{ session('status') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Login Gagal!</strong><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="admin@sdn7bangsri.sch.id"
                            required 
                            autofocus
                        >
                    </div>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                    </div>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <span id="loginText">🔐 Login ke Dashboard</span>
                </button>

                <!-- Forgot Password Link -->
                <div class="forgot-link">
                    <a href="{{ route('password.request') }}">🔑 Lupa Sandi?</a>
                </div>
            </form>

            <!-- Back to Home -->
            <div class="back-link">
                <a href="{{ route('home') }}">← Kembali ke Website</a>
            </div>
        </div>
    </div>

    <script>
        // Form submission handling with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            const btnText = document.getElementById('loginText');
            
            btn.disabled = true;
            btnText.innerHTML = '<span class="loading"></span> Memproses...';
        });

        // Auto-hide error after 5 seconds
        const alert = document.querySelector('.alert-danger');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>