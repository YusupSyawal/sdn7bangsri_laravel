<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SD Negeri 7 Bangsri')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ========================================
           GLOBAL SCALING - Tampilan seperti zoom 110%
        ======================================== */
        html {
            font-size: 17.6px; /* Base 16px x 1.1 = 17.6px (110% scale) */
        }

        @media (max-width: 1400px) {
            html {
                font-size: 17px;
            }
        }

        @media (max-width: 1200px) {
            html {
                font-size: 16.5px;
            }
        }

        @media (max-width: 768px) {
            html {
                font-size: 16px;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            color: #333;
            font-size: 1rem;
        }

        /* ========================================
           EMOJI GRAYSCALE - Icon hitam putih
        ======================================== */
        .emoji, .icon, .stat-icon, .contact-icon, .info-card-icon, .step-icon, .feature-icon, .file-upload-icon, .alert-icon, .ppdb-banner-icon {
            filter: grayscale(100%);
            -webkit-filter: grayscale(100%);
        }

        /* ========================================
           PPDB BANNER - Sticky di bawah navbar
        ======================================== */
        .ppdb-banner {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            padding: 1rem 2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
            position: relative;
            overflow: hidden;
        }

        .ppdb-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M20 20.5V18H0v-2h20v-2l4 3-4 3zm0-1V24h20v2H20v2l-4-3 4-3z'/%3E%3C/g%3E%3C/svg%3E");
            animation: slide 15s linear infinite;
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-40px); }
        }

        .ppdb-banner-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            max-width: 1400px;
            margin: 0 auto;
        }

        .ppdb-banner-icon {
            font-size: 2rem;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .ppdb-banner-text {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1f2937;
            text-shadow: 0 1px 2px rgba(255,255,255,0.3);
        }

        .ppdb-banner-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .ppdb-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .ppdb-btn-red {
            background: #dc2626;
            color: white;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.4);
        }

        .ppdb-btn-red:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(220, 38, 38, 0.5);
        }

        .ppdb-btn-white {
            background: white;
            color: #1f2937;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .ppdb-btn-white:hover {
            background: #f9fafb;
            transform: translateY(-2px);
        }

        .ppdb-banner-close {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.3);
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .ppdb-banner-close:hover {
            background: rgba(255,255,255,0.6);
        }

        @media (max-width: 768px) {
            .ppdb-banner {
                padding: 1rem;
            }

            .ppdb-banner-content {
                flex-direction: column;
                gap: 0.75rem;
            }

            .ppdb-banner-text {
                font-size: 1rem;
            }

            .ppdb-btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            .ppdb-banner-close {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                margin-top: 0.5rem;
            }
        }

        /* ========================================
           NAVIGATION - Diperbesar
        ======================================== */
        nav {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1400px; /* Diperlebar dari 1200px */
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.1rem 2.5rem; /* Padding diperbesar */
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.35rem; /* Diperbesar dari 1.2rem */
            font-weight: bold;
            color: #2d3748;
        }

        .logo img {
            width: 45px; /* Diperbesar dari 40px */
            height: 45px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2.2rem; /* Diperbesar dari 2rem */
        }

        .nav-menu a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            font-size: 1.05rem; /* Font diperbesar */
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: #10b981;
        }

        /* ========================================
           CONTAINER - Diperlebar
        ======================================== */
        .container {
            max-width: 1400px; /* Diperlebar dari 1200px */
            margin: 0 auto;
            padding: 2.2rem; /* Padding diperbesar */
        }

        /* ========================================
           FOOTER - Diperbesar
        ======================================== */
        footer {
            background: #1a5c3d;
            color: white;
            padding: 3.5rem 2.5rem; /* Padding diperbesar */
        }

        .footer-content {
            max-width: 1400px; /* Diperlebar dari 1200px */
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Min-width diperbesar */
            gap: 2.5rem; /* Gap diperbesar */
        }

        .footer-section h3 {
            margin-bottom: 1.1rem;
            color: #a7f3d0;
            font-size: 1.2rem; /* Font diperbesar */
        }

        .footer-section p {
            margin-bottom: 0.6rem;
            font-size: 1rem;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            font-size: 0.95rem;
        }

        /* ========================================
           MOBILE NAVIGATION
        ======================================== */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (max-width: 900px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem 2rem;
                gap: 0;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu li {
                padding: 0.75rem 0;
                border-bottom: 1px solid #e5e7eb;
            }

            .nav-menu li:last-child {
                border-bottom: none;
            }

            .nav-container {
                padding: 1rem 1.5rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                ● <span>SDN 7 Bangsri</span>
            </div>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('about') }}">Tentang</a></li>
                <li><a href="{{ route('teachers') }}">Guru</a></li>
                <li><a href="{{ route('activities') }}">Kegiatan</a></li>
                <li><a href="{{ route('posts.index') }}">Berita</a></li>
                <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                <li><a href="{{ route('gallery') }}">Galeri</a></li>
                <li><a href="{{ route('ppdb') }}" style="color: #dc2626; font-weight: bold;">PPDB</a></li>
                <li><a href="{{ route('contact') }}">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- PPDB Banner - Tampil saat masa PPDB -->
    @if(!session('ppdb_banner_closed'))
    <div class="ppdb-banner" id="ppdbBanner">
        <div class="ppdb-banner-content">
            <span class="ppdb-banner-icon">●</span>
            <span class="ppdb-banner-text">PPDB Tahun Ajaran 2026/2027 Telah Dibuka!</span>
            <div class="ppdb-banner-buttons">
                <a href="{{ route('ppdb') }}" class="ppdb-btn ppdb-btn-red">
                    ► Daftar Sekarang
                </a>
                <a href="{{ route('ppdb') }}#syarat-pendaftaran" class="ppdb-btn ppdb-btn-white">
                    ► Lihat Syarat
                </a>
            </div>
        </div>
        <button class="ppdb-banner-close" onclick="closePpdbBanner()" title="Tutup">×</button>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>● SDN 7 Bangsri</h3>
                <p>Membangun generasi muda yang cerdas dan berkarakter sejak 2003</p>
            </div>

            <div class="footer-section">
                <h3>Hubungi Kami</h3>
                <p>◆ {{ $profile->address ?? 'Alamat belum diisi' }}</p>
                <p>◆ {{ $profile->email ?? 'Email belum diisi' }}</p>
                <p>◆ {{ $profile->phone ?? 'Telepon belum diisi' }}</p>
            </div>

            <div class="footer-section">
                <h3>Jam Sekolah</h3>
                <p>{{ $profile->school_hours ?? 'Jam sekolah belum diisi' }}</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 SDN 7 Bangsri. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    @yield('scripts')

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('navMenu');
            menu.classList.toggle('active');
        }

        // Close PPDB Banner
        function closePpdbBanner() {
            const banner = document.getElementById('ppdbBanner');
            if (banner) {
                banner.style.transition = 'all 0.3s ease';
                banner.style.opacity = '0';
                banner.style.transform = 'translateY(-100%)';
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 300);
                
                // Simpan ke session storage (banner tidak tampil lagi di session ini)
                sessionStorage.setItem('ppdb_banner_closed', 'true');
            }
        }

        // Check session storage on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (sessionStorage.getItem('ppdb_banner_closed') === 'true') {
                const banner = document.getElementById('ppdbBanner');
                if (banner) {
                    banner.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>