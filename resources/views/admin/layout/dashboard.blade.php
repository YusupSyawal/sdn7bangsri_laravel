@extends('admin.layout.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview statistik website sekolah')

@section('styles')
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-icon.pink {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
    }

    .stat-info h3 {
        font-size: 2rem;
        color: #1a202c;
        margin-bottom: 0.25rem;
        font-weight: 700;
    }

    .stat-info p {
        color: #718096;
        font-size: 0.95rem;
    }

    /* Quick Actions */
    .quick-actions {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .quick-actions h2 {
        font-size: 1.5rem;
        color: #1a202c;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.5rem;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        text-decoration: none;
        color: #2d3748;
        transition: all 0.3s;
        text-align: center;
    }

    .action-btn:hover {
        background: white;
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .action-btn .icon {
        font-size: 2.5rem;
    }

    .action-btn .text {
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Recent Activity */
    .recent-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .info-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .info-card h3 {
        font-size: 1.25rem;
        color: #1a202c;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-list {
        list-style: none;
    }

    .info-list li {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f7fafc;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-list li:last-child {
        border-bottom: none;
    }

    .info-list .badge {
        background: #e2e8f0;
        color: #2d3748;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .info-list .badge.active {
        background: #d1fae5;
        color: #065f46;
    }

    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-text h2 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .welcome-text p {
        opacity: 0.9;
        font-size: 1.05rem;
    }

    .welcome-icon {
        font-size: 4rem;
        opacity: 0.3;
    }

    @media (max-width: 768px) {
        .welcome-banner {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .recent-section {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>👋 Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p>Kelola konten website SD Negeri 7 Bangsri dengan mudah</p>
    </div>
    <div class="welcome-icon">🎓</div>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">🖼️</div>
        <div class="stat-info">
            <h3>{{ $stats['sliders'] }}</h3>
            <p>Hero Sliders</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">🎨</div>
        <div class="stat-info">
            <h3>{{ $stats['activities'] }}</h3>
            <p>Kegiatan</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">👨‍🏫</div>
        <div class="stat-info">
            <h3>{{ $stats['teachers'] }}</h3>
            <p>Guru</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon pink">📸</div>
        <div class="stat-info">
            <h3>{{ $stats['galleries'] }}</h3>
            <p>Foto Galeri</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2>⚡ Quick Actions</h2>
    <div class="actions-grid">
        <a href="{{ route('admin.sliders.create') }}" class="action-btn">
            <span class="icon">🖼️</span>
            <span class="text">Tambah Slider</span>
        </a>

        <a href="{{ route('admin.activities.create') }}" class="action-btn">
            <span class="icon">🎨</span>
            <span class="text">Tambah Kegiatan</span>
        </a>

        <a href="{{ route('admin.teachers.create') }}" class="action-btn">
            <span class="icon">👨‍🏫</span>
            <span class="text">Tambah Guru</span>
        </a>

        <a href="{{ route('admin.galleries.create') }}" class="action-btn">
            <span class="icon">📸</span>
            <span class="text">Tambah Foto</span>
        </a>

        <a href="{{ route('admin.profile.edit') }}" class="action-btn">
            <span class="icon">🏫</span>
            <span class="text">Edit Profil</span>
        </a>

        <a href="{{ route('home') }}" class="action-btn" target="_blank">
            <span class="icon">🌐</span>
            <span class="text">Lihat Website</span>
        </a>
    </div>
</div>

<!-- Recent Information -->
<div class="recent-section">
    <div class="info-card">
        <h3>📊 Statistik Konten</h3>
        <ul class="info-list">
            <li>
                <span>Total Hero Sliders</span>
                <span class="badge active">{{ $stats['sliders'] }} items</span>
            </li>
            <li>
                <span>Total Kegiatan</span>
                <span class="badge active">{{ $stats['activities'] }} items</span>
            </li>
            <li>
                <span>Total Guru</span>
                <span class="badge active">{{ $stats['teachers'] }} orang</span>
            </li>
            <li>
                <span>Total Foto</span>
                <span class="badge active">{{ $stats['galleries'] }} items</span>
            </li>
        </ul>
    </div>

    <div class="info-card">
        <h3>ℹ️ Informasi Sistem</h3>
        <ul class="info-list">
            <li>
                <span>Laravel Version</span>
                <span class="badge">{{ app()->version() }}</span>
            </li>
            <li>
                <span>PHP Version</span>
                <span class="badge">{{ PHP_VERSION }}</span>
            </li>
            <li>
                <span>Database</span>
                <span class="badge">{{ config('database.default') }}</span>
            </li>
            <li>
                <span>Logged in as</span>
                <span class="badge active">{{ auth()->user()->email }}</span>
            </li>
        </ul>
    </div>

    <div class="info-card">
        <h3>💡 Tips Admin</h3>
        <ul class="info-list">
            <li style="border: none; display: block; padding: 0.5rem 0;">
                📌 Pastikan gambar yang diupload tidak lebih dari 2MB
            </li>
            <li style="border: none; display: block; padding: 0.5rem 0;">
                📌 Gunakan format JPG, JPEG, atau PNG untuk gambar
            </li>
            <li style="border: none; display: block; padding: 0.5rem 0;">
                📌 Update profil sekolah secara berkala
            </li>
            <li style="border: none; display: block; padding: 0.5rem 0;">
                📌 Backup data secara rutin untuk keamanan
            </li>
        </ul>
    </div>
</div>
@endsection