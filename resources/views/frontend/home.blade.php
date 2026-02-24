@extends('frontend.layout.app')

@section('title', 'Beranda - SD Negeri 7 Bangsri')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        padding: 4.5rem 2.5rem;
        text-align: center;
    }

    .hero h1 {
        font-size: 2.75rem;
        color: #1a5c3d;
        margin-bottom: 1.1rem;
    }

    .hero p {
        font-size: 1.3rem;
        color: #2d3748;
    }

    .slider-container {
        max-width: 1100px;
        margin: 2.5rem auto;
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .slider-item {
        display: none;
        position: relative;
    }

    .slider-item.active {
        display: block;
    }

    .slider-item img {
        width: 100%;
        height: 520px;
        object-fit: cover;
    }

    .slider-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 2.5rem;
    }

    .slider-caption h2 {
        font-size: 2.2rem;
        margin-bottom: 0.6rem;
    }

    /* About Section */
    .about-section {
        padding: 4.5rem 2.5rem;
        background: white;
    }

    .about-section .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .about-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.2rem;
        margin-top: 2.2rem;
    }

    .about-card {
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s;
    }

    .about-card:nth-child(1) { background: #a7f3d0; }
    .about-card:nth-child(2) { background: #fef3c7; }
    .about-card:nth-child(3) { background: #fecaca; }
    .about-card:nth-child(4) { background: #bfdbfe; }

    .about-card:hover {
        transform: translateY(-10px);
    }

    .about-card h3 {
        font-size: 1.6rem;
        margin-bottom: 1.1rem;
        color: #1a202c;
    }

    /* ========================================
       STATISTICS SECTION
    ======================================== */
    .statistics-section {
        padding: 4rem 2.5rem 5rem;
        background: linear-gradient(180deg, #a7f3d0 0%, #d1fae5 30%, #f0fdf4 70%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .statistics-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a5c3d' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    }

    .statistics-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .statistics-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .statistics-header h2 {
        font-size: 2.2rem;
        color: #1a5c3d;
        margin-bottom: 0.5rem;
    }

    .statistics-header p {
        color: #065f46;
        font-size: 1.1rem;
    }

    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    @media (max-width: 900px) {
        .statistics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .statistics-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: white;
        border: 1px solid #d1fae5;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.2);
        border-color: #10b981;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a5c3d;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 1rem;
        color: #059669;
        font-weight: 500;
    }

    /* Activities Section */
    .activities-section {
        padding: 4.5rem 2.5rem;
        background: #f7fafc;
    }

    .activities-section .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .section-title {
        text-align: center;
        font-size: 2.2rem;
        margin-bottom: 1.1rem;
        color: #1a202c;
    }

    .section-subtitle {
        text-align: center;
        color: #718096;
        margin-bottom: 3rem;
    }

    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2.2rem;
    }

    .activity-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .activity-card:hover {
        transform: translateY(-5px);
    }

    .activity-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .activity-content {
        padding: 1.75rem;
    }

    .activity-content h3 {
        font-size: 1.4rem;
        margin-bottom: 0.6rem;
        color: #1a202c;
    }

    .activity-content p {
        color: #718096;
    }

    /* Teachers Section */
    .teachers-section {
        padding: 4.5rem 2.5rem;
        background: white;
    }

    .teachers-section .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.2rem;
    }

    .teacher-card {
        background: white;
        border-radius: 12px;
        padding: 2.2rem;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .teacher-card:hover {
        transform: translateY(-5px);
    }

    .teacher-card img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1.1rem;
    }

    .teacher-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.6rem;
        color: #1a202c;
    }

    .teacher-card p {
        color: #718096;
    }

    .btn-contact {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.5rem 1.5rem;
        background: #10b981;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .btn-contact:hover {
        background: #059669;
    }

    /* Location Section */
    .location-section {
        padding: 4rem 2rem;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
    }

    .location-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
    }

    .location-info h2 {
        font-size: 2rem;
        color: #0369a1;
        margin-bottom: 1rem;
    }

    .location-info p {
        color: #334155;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .location-address {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-top: 1.5rem;
    }

    .location-address h4 {
        color: #0369a1;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .location-address p {
        margin: 0;
        color: #475569;
    }

    .location-map {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: transform 0.3s;
    }

    .location-map:hover {
        transform: scale(1.02);
    }

    .location-map img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        display: block;
    }

    .location-map-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(3, 105, 161, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .location-map:hover .location-map-overlay {
        opacity: 1;
    }

    .location-map-overlay .icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .location-map-overlay span {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .btn-maps {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
        padding: 0.75rem 1.5rem;
        background: #0369a1;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-maps:hover {
        background: #0284c7;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .location-container {
            grid-template-columns: 1fr;
        }

        .location-map img {
            height: 250px;
        }
    }

    /* ========================================
       PORTAL BERITA SECTION
    ======================================== */
    .news-portal-section {
        padding: 4rem 2rem;
        background: #f8fafc;
    }

    .news-portal-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .news-portal-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .news-portal-header h2 {
        font-size: 2.2rem;
        color: #1a5c3d;
        margin-bottom: 0.5rem;
    }

    .news-portal-header p {
        color: #64748b;
        font-size: 1.1rem;
    }

    .news-portal-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2.5rem;
    }

    /* Kolom Kiri - Berita Sekolah */
    .news-column {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .news-column-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #10b981;
        margin-bottom: 1.5rem;
    }

    .news-column-header h3 {
        font-size: 1.3rem;
        color: #1f2937;
        margin: 0;
    }

    .news-column-header .icon {
        font-size: 1.5rem;
    }

    /* Headline Berita */
    .news-headline {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .news-headline img {
        width: 100%;
        height: 280px;
        object-fit: cover;
    }

    .news-headline-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.85));
        padding: 2rem 1.5rem 1.5rem;
        color: white;
    }

    .news-headline-overlay h4 {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .news-headline-overlay .date {
        font-size: 0.85rem;
        opacity: 0.8;
        margin-bottom: 1rem;
    }

    .btn-read-more {
        display: inline-block;
        padding: 0.5rem 1.25rem;
        background: #10b981;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-read-more:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    /* Daftar Berita Kecil */
    .news-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .news-item {
        display: flex;
        gap: 1rem;
        padding: 0.75rem;
        border-radius: 10px;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .news-item:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }

    .news-item-thumb {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .news-item-thumb-placeholder {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #94a3b8;
        flex-shrink: 0;
    }

    .news-item-content h5 {
        font-size: 0.95rem;
        color: #1f2937;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-item-content .date {
        font-size: 0.8rem;
        color: #64748b;
    }

    .btn-all-news {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        padding: 0.75rem 1.5rem;
        background: #1a5c3d;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-all-news:hover {
        background: #166534;
        transform: translateY(-2px);
    }

    /* Kolom Kanan - Artikel & Jurnal */
    .article-column {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .article-column-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #3b82f6;
        margin-bottom: 1.5rem;
    }

    .article-column-header h3 {
        font-size: 1.3rem;
        color: #1f2937;
        margin: 0;
    }

    .article-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .article-item {
        display: flex;
        gap: 1rem;
        padding: 0.75rem;
        border-radius: 10px;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        border-left: 3px solid transparent;
    }

    .article-item:hover {
        background: #eff6ff;
        border-left-color: #3b82f6;
    }

    .article-item-thumb {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .article-item-thumb-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #3b82f6;
        flex-shrink: 0;
    }

    .article-item-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .article-item-content h5 {
        font-size: 0.95rem;
        color: #1f2937;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-item-content .date {
        font-size: 0.8rem;
        color: #64748b;
    }

    .btn-all-articles {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        padding: 0.75rem 1.5rem;
        background: #1e40af;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-all-articles:hover {
        background: #1e3a8a;
        transform: translateY(-2px);
    }

    /* Empty State */
    .news-empty, .article-empty {
        text-align: center;
        padding: 2rem;
        color: #94a3b8;
    }

    .news-empty .icon, .article-empty .icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .news-portal-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .news-headline img {
            height: 200px;
        }

        .news-headline-overlay h4 {
            font-size: 1.1rem;
        }

        .news-item-thumb,
        .news-item-thumb-placeholder {
            width: 70px;
            height: 50px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <h1>Selamat Datang di SD Negeri 7 Bangsri</h1>
    <p>{{ $profile->welcome_message ?? 'Dimana anak-anak tersenyum bahagia ' }}</p>

    <!-- Slider -->
    <div class="slider-container">
        @forelse($sliders as $index => $slider)
        <div class="slider-item {{ $index === 0 ? 'active' : '' }}">
            @if($slider->image)
                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}">
            @else
                <div style="width:100%;height:500px;background:linear-gradient(135deg,#bfdbfe 0%,#93c5fd 100%);display:flex;align-items:center;justify-content:center;font-size:4rem;">□</div>
            @endif
            <div class="slider-caption">
                <h2>{{ $slider->title }}</h2>
                <p>{{ $slider->subtitle }}</p>
            </div>
        </div>
        @empty
        <div class="slider-item active">
            <img src="https://via.placeholder.com/1000x500?text=Selamat+Datang" alt="Default">
            <div class="slider-caption">
                <h2>Masa Depan Cerah</h2>
                <p>Membentuk pemimpin masa depan hari ini</p>
            </div>
        </div>
        @endforelse
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics-section">
    <div class="statistics-container">
        <div class="statistics-header">
            <h2>◆ Data Sekolah Kami</h2>
            <p>Tahun Ajaran {{ $statistic->tahun_ajaran ?? '2026/2027' }}</p>
        </div>

        <div class="statistics-grid">
            <div class="stat-card">
                <div class="stat-icon">○</div>
                <div class="stat-value">{{ $statistic->tahun_ajaran ?? '2026/2027' }}</div>
                <div class="stat-label">Tahun Ajaran</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">○</div>
                <div class="stat-value">{{ $statistic->peserta_didik ?? 0 }}</div>
                <div class="stat-label">Peserta Didik</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">○</div>
                <div class="stat-value">{{ $statistic->guru ?? 0 }}</div>
                <div class="stat-label">Tenaga Pendidik</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">○</div>
                <div class="stat-value">{{ $statistic->rombel ?? 0 }}</div>
                <div class="stat-label">Rombongan Belajar</div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="location-section">
    <div class="location-container">
        <div class="location-info">
            <h2>◆ Lokasi Sekolah</h2>
            <p>SD Negeri 7 Bangsri terletak di lokasi yang strategis dan mudah dijangkau. Kami menyediakan lingkungan belajar yang aman dan nyaman untuk putra-putri Anda.</p>
            
            <div class="location-address">
                <h4>▶ Alamat Lengkap</h4>
                <p>{{ $profile->address ?? 'Jl. Raya Bangsri, Kec. Bangsri, Kab. Jepara, Jawa Tengah' }}</p>
            </div>

            <a href="{{ $profile->google_maps_url ?? 'https://maps.google.com/?q=SD+Negeri+7+Bangsri+Jepara' }}" target="_blank" class="btn-maps">
                ▶ Buka di Google Maps
            </a>
        </div>
        
        <a href="{{ $profile->google_maps_url ?? 'https://maps.google.com/?q=SD+Negeri+7+Bangsri+Jepara' }}" target="_blank" class="location-map">
            @if($profile && $profile->location_image)
                <img src="{{ asset('storage/' . $profile->location_image) }}" alt="Denah Lokasi SD Negeri 7 Bangsri">
            @else
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=SD+Negeri+7+Bangsri,Jepara&zoom=15&size=600x350&maptype=roadmap&markers=color:red%7CSD+Negeri+7+Bangsri,Jepara&key=YOUR_API_KEY" 
                     alt="Peta Lokasi SD Negeri 7 Bangsri"
                     onerror="this.src='https://via.placeholder.com/600x350/0369a1/ffffff?text=Lokasi+Sekolah'">
            @endif
            <div class="location-map-overlay">
                <div class="icon">◆</div>
                <span>Klik untuk buka Google Maps</span>
            </div>
        </a>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <h2 class="section-title">Tentang Sekolah Kami □</h2>
        <p class="section-subtitle">Membangun masa depan cerah bersama</p>

        <div class="about-grid">
            <div class="about-card">
                <div style="font-size: 3rem;">○</div>
                <h3>Visi Kami</h3>
                <p>{{ Str::limit($profile->vision ?? 'Visi belum diisi', 120) }}</p>
            </div>

            <div class="about-card">
                <div style="font-size: 3rem;">○</div>
                <h3>Misi Kami</h3>
                <p>{{ Str::limit($profile->mission ?? 'Misi belum diisi', 120) }}</p>
            </div>

            <div class="about-card">
                <div style="font-size: 3rem;">○</div>
                <h3>Nilai-Nilai Kami</h3>
                <p>{{ Str::limit($profile->values ?? 'Nilai belum diisi', 120) }}</p>
            </div>

            <div class="about-card">
                <div style="font-size: 3rem;">○</div>
                <h3>Pendekatan Kami</h3>
                <p>{{ Str::limit($profile->approach ?? 'Pendekatan belum diisi', 120) }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Portal Berita Section -->
<section class="news-portal-section">
    <div class="news-portal-container">
        <div class="news-portal-header">
            <h2>◆ Portal Berita & Artikel</h2>
            <p>Informasi terbaru seputar kegiatan dan perkembangan sekolah</p>
        </div>

        <div class="news-portal-grid">
            <!-- Kolom Kiri: Berita Sekolah -->
            <div class="news-column">
                <div class="news-column-header">
                    <span class="icon">○</span>
                    <h3>Berita Sekolah</h3>
                </div>

                @if($headlinePost)
                <!-- Headline Berita -->
                <a href="{{ route('posts.show', $headlinePost->slug) }}" class="news-headline">
                    @if($headlinePost->image)
                        <img src="{{ $headlinePost->image_url }}" alt="{{ $headlinePost->title }}">
                    @else
                        <div style="width:100%;height:280px;background:linear-gradient(135deg,#d1fae5 0%,#a7f3d0 100%);display:flex;align-items:center;justify-content:center;">
                            <span style="font-size:4rem;color:#059669;">○</span>
                        </div>
                    @endif
                    <div class="news-headline-overlay">
                        <h4>{{ $headlinePost->title }}</h4>
                        <div class="date">○ {{ $headlinePost->formatted_date }}</div>
                        <span class="btn-read-more">Selengkapnya ▶</span>
                    </div>
                </a>

                <!-- Daftar Berita Kecil -->
                <div class="news-list">
                    @forelse($latestPosts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="news-item">
                        @if($post->image)
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="news-item-thumb">
                        @else
                            <div class="news-item-thumb-placeholder">○</div>
                        @endif
                        <div class="news-item-content">
                            <h5>{{ $post->title }}</h5>
                            <span class="date">{{ $post->formatted_date }}</span>
                        </div>
                    </a>
                    @empty
                    <div class="news-empty">
                        <div class="icon">○</div>
                        <p>Belum ada berita lainnya</p>
                    </div>
                    @endforelse
                </div>
                @else
                <div class="news-empty">
                    <div class="icon">○</div>
                    <p>Belum ada berita terbaru</p>
                </div>
                @endif

                <a href="{{ route('posts.index') }}" class="btn-all-news">
                    Semua Berita ▶
                </a>
            </div>

            <!-- Kolom Kanan: Artikel & Jurnal -->
            <div class="article-column">
                <div class="article-column-header">
                    <span class="icon">○</span>
                    <h3>Artikel & Jurnal</h3>
                </div>

                <div class="article-list">
                    @forelse($latestArticles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="article-item">
                        @if($article->image)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-item-thumb">
                        @else
                            <div class="article-item-thumb-placeholder">○</div>
                        @endif
                        <div class="article-item-content">
                            <h5>{{ $article->title }}</h5>
                            <span class="date">{{ $article->formatted_date }}</span>
                        </div>
                    </a>
                    @empty
                    <div class="article-empty">
                        <div class="icon">○</div>
                        <p>Belum ada artikel</p>
                    </div>
                    @endforelse
                </div>

                <a href="{{ route('articles.index') }}" class="btn-all-articles">
                    Semua Artikel ▶
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section class="activities-section">
    <div class="container">
        <h2 class="section-title">Kegiatan Kami</h2>
        <p class="section-subtitle">Belajar melalui bermain dan eksplorasi</p>

        <div class="activities-grid">
            @forelse($activities as $activity)
            <div class="activity-card">
                @if($activity->image)
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}">
                @else
                    <div style="width:100%;height:200px;background:linear-gradient(135deg,#c7d2fe 0%,#a5b4fc 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;">○</div>
                @endif
                <div class="activity-content">
                    <h3>{{ $activity->title }}</h3>
                    <p>{{ Str::limit($activity->description, 100) }}</p>
                </div>
            </div>
            @empty
            <p>Belum ada aktivitas</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Teachers Section -->
<section class="teachers-section">
    <div class="container">
        <h2 class="section-title">Guru-Guru Kami</h2>
        <p class="section-subtitle">Tenaga profesional yang peduli dengan anak Anda</p>

        <div class="teachers-grid">
            @forelse($teachers as $teacher)
            <div class="teacher-card">
                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}">
                @else
                    <div style="width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,#a7f3d0 0%,#6ee7b7 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;margin:0 auto 1rem;">○</div>
                @endif
                <h3>{{ $teacher->name }}</h3>
                <p>{{ $teacher->subject }}</p>
                <p style="font-size: 0.9rem; margin-top: 0.5rem;">
                    <strong>Keahlian:</strong> {{ $teacher->specialty }}<br>
                    <strong>Pengalaman:</strong> {{ $teacher->experience }} tahun
                </p>
                <a href="{{ route('contact') }}" class="btn-contact">Hubungi</a>
            </div>
            @empty
            <p>Belum ada data guru</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Simple slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider-item');

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active'));
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Auto slide every 5 seconds
    if (slides.length > 1) {
        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);
    }
</script>
@endsection




