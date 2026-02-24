<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Sandi - Admin SD Negeri 7 Bangsri</title>
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

        .reset-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            padding: 3rem;
        }

        .reset-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .reset-header .icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .reset-header h2 {
            font-size: 1.8rem;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .reset-header p {
            color: #718096;
            font-size: 1rem;
            line-height: 1.6;
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

        .btn-reset {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #f56565 0%, #c53030 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 101, 101, 0.3);
        }

        .btn-reset:active {
            transform: translateY(0);
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

        .alert-success {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            color: #276749;
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

        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            border-radius: 2px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s;
        }

        .strength-weak { background: #f56565; width: 33%; }
        .strength-medium { background: #ed8936; width: 66%; }
        .strength-strong { background: #48bb78; width: 100%; }

        .password-hint {
            font-size: 0.8rem;
            color: #718096;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .reset-container {
                padding: 2rem;
            }

            .reset-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-header">
            <div class="icon">🔑</div>
            <h2>Lupa Sandi?</h2>
            <p>Masukkan email admin dan sandi baru Anda. Pastikan Anda adalah administrator yang berwenang.</p>
        </div>

        @if (session('status'))
        <div class="alert alert-success">
            ✅ {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Gagal!</strong><br>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" id="resetForm">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email Admin</label>
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
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- New Password Field -->
            <div class="form-group">
                <label for="password">Sandi Baru</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan sandi baru (minimal 8 karakter)"
                    required
                    minlength="8"
                >
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <p class="password-hint">Gunakan kombinasi huruf, angka, dan simbol untuk sandi yang kuat</p>
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Sandi Baru</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi sandi baru"
                    required
                    minlength="8"
                >
            </div>

            <!-- Admin Secret Key (optional security) -->
            <div class="form-group">
                <label for="secret_key">Kunci Rahasia Admin</label>
                <input 
                    type="password" 
                    class="form-control @error('secret_key') is-invalid @enderror" 
                    id="secret_key" 
                    name="secret_key" 
                    placeholder="Masukkan kunci rahasia"
                    required
                >
                <p class="password-hint">Kunci rahasia default: admin123 (hubungi administrator jika tidak tahu)</p>
                @error('secret_key')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-reset" id="resetBtn">
                🔐 Reset Sandi
            </button>
        </form>

        <!-- Back to Login -->
        <div class="back-link">
            <a href="{{ route('login') }}">← Kembali ke Login</a>
        </div>
    </div>

    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.getElementById('strengthBar');
            
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
                return;
            }
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            if (strength <= 1) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        // Form submission
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            
            if (password !== confirmation) {
                e.preventDefault();
                alert('Konfirmasi sandi tidak cocok!');
                return;
            }
            
            const btn = document.getElementById('resetBtn');
            btn.disabled = true;
            btn.innerHTML = '⏳ Memproses...';
        });
    </script>
</body>
</html>
