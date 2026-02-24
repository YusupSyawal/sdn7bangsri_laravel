<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SD Negeri 7 Bangsri</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1a5c3d 0%, #0f3a26 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header .logo {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-header h2 {
            font-size: 1.2rem;
            color: #a7f3d0;
        }

        .sidebar-header p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.25rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: block;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #a7f3d0;
        }

        .menu-item.active {
            background: rgba(167, 243, 208, 0.15);
            color: #a7f3d0;
            border-left-color: #a7f3d0;
            font-weight: 600;
        }

        .menu-item i {
            margin-right: 0.75rem;
            width: 20px;
            display: inline-block;
        }

        .menu-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 1rem 1.5rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left h1 {
            font-size: 1.5rem;
            color: #1a202c;
        }

        .topbar-left p {
            font-size: 0.875rem;
            color: #718096;
            margin-top: 0.25rem;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .user-name {
            font-weight: 600;
            color: #2d3748;
        }

        .user-role {
            font-size: 0.8rem;
            color: #718096;
        }

        .btn-logout {
            padding: 0.5rem 1.25rem;
            background: #f56565;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-logout:hover {
            background: #e53e3e;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 2rem;
        }

        /* Footer */
        .admin-footer {
            background: white;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 0.875rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .alert-info {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            color: #1e40af;
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: #1a5c3d;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .topbar {
                padding: 1rem;
            }

            .topbar-left h1 {
                font-size: 1.2rem;
            }

            .user-name,
            .user-role {
                display: none;
            }

            .content {
                padding: 1rem;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">🎓</div>
            <h2>SDN 7 Bangsri</h2>
            <p>Admin Panel</p>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i>📊</i> Dashboard
            </a>

            <div class="menu-divider"></div>

            <a href="{{ route('admin.profile.edit') }}" class="menu-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i>🏫</i> Profil Sekolah
            </a>

            <a href="{{ route('admin.statistics.edit') }}" class="menu-item {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                <i>📊</i> Statistik Sekolah
            </a>

            <a href="{{ route('admin.sliders.index') }}" class="menu-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i>🖼️</i> Hero Slider
            </a>

            <a href="{{ route('admin.activities.index') }}" class="menu-item {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                <i>🎨</i> Kegiatan
            </a>

            <a href="{{ route('admin.teachers.index') }}" class="menu-item {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <i>👨‍🏫</i> Data Guru
            </a>

            <a href="{{ route('admin.galleries.index') }}" class="menu-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <i>📸</i> Galeri
            </a>

            <div class="menu-divider"></div>

            <a href="{{ route('home') }}" class="menu-item" target="_blank">
                <i>🌐</i> Lihat Website
            </a>
        </nav>
    </aside>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" id="mobileToggle">☰</button>
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>@yield('page-subtitle', 'Selamat datang di admin panel')</p>
            </div>

            <div class="topbar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">🚪 Logout</button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
            <div class="alert alert-success">
                <span style="font-size: 1.5rem;">✅</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <span style="font-size: 1.5rem;">❌</span>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="admin-footer">
            <p>&copy; 2026 SD Negeri 7 Bangsri. All rights reserved.</p>
        </footer>
    </main>

    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileToggle = document.getElementById('mobileToggle');

        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    </script>

    @yield('scripts')
</body>
</html>