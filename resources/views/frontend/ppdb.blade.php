@extends('frontend.layout.app')

@section('title', 'PPDB - SD Negeri 7 Bangsri')

@section('styles')
<style>
    /* ========================================
       PPDB PAGE STYLES - SD Negeri 7 Bangsri
       Modern, Parent-Friendly Design
    ======================================== */

    /* Hero Section */
    .ppdb-hero {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%);
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .ppdb-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: float 20s linear infinite;
        opacity: 0.5;
    }

    @keyframes float {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-50%, -50%); }
    }

    .ppdb-hero-content {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }

    .ppdb-badge {
        display: inline-block;
        background: #dc2626;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: bold;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .ppdb-hero h1 {
        font-size: 2.5rem;
        color: #1f2937;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .ppdb-hero h1 span {
        color: #059669;
    }

    .ppdb-hero-subtitle {
        font-size: 1.2rem;
        color: #4b5563;
        margin-bottom: 2rem;
    }

    /* Countdown Timer */
    .countdown-container {
        background: white;
        border-radius: 15px;
        padding: 1.5rem 2rem;
        display: inline-block;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .countdown-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .countdown {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .countdown-item {
        text-align: center;
        min-width: 70px;
    }

    .countdown-number {
        display: block;
        font-size: 2.5rem;
        font-weight: bold;
        color: #dc2626;
        line-height: 1;
    }

    .countdown-text {
        font-size: 0.8rem;
        color: #6b7280;
        text-transform: uppercase;
    }

    /* Hero Buttons */
    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.5);
    }

    .btn-secondary {
        background: white;
        color: #1f2937;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-secondary:hover {
        transform: translateY(-3px);
        background: #f9fafb;
    }

    .btn-outline {
        background: transparent;
        color: #1f2937;
        border: 2px solid #1f2937;
    }

    .btn-outline:hover {
        background: #1f2937;
        color: white;
    }

    /* Section Styles */
    .section {
        padding: 4rem 2rem;
    }

    .section-alt {
        background: #f3f4f6;
    }

    .section-green {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
    }

    /* Info Cards Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .info-card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .info-card-icon.green { background: #d1fae5; }
    .info-card-icon.yellow { background: #fef3c7; }
    .info-card-icon.blue { background: #dbeafe; }
    .info-card-icon.red { background: #fee2e2; }

    .info-card h3 {
        font-size: 1.1rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .info-card p {
        font-size: 1.3rem;
        color: #1f2937;
        font-weight: 600;
    }

    /* Requirements Section */
    .requirements-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .requirement-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .requirement-icon {
        width: 50px;
        height: 50px;
        background: #d1fae5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .requirement-text {
        font-size: 1rem;
        color: #1f2937;
    }

    /* Steps Section */
    .steps-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        flex: 1;
        min-width: 200px;
        max-width: 250px;
        position: relative;
    }

    .step-item:not(:last-child)::after {
        content: '→';
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        color: #10b981;
        font-weight: bold;
    }

    @media (max-width: 900px) {
        .step-item:not(:last-child)::after {
            content: '↓';
            position: relative;
            right: auto;
            top: auto;
            transform: none;
            margin-top: 1rem;
        }
    }

    .step-number {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .step-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .step-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .step-desc {
        font-size: 0.9rem;
        color: #6b7280;
    }

    /* Why Choose Section */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }

    .feature-card:nth-child(1) .feature-icon { background: #dbeafe; }
    .feature-card:nth-child(2) .feature-icon { background: #d1fae5; }
    .feature-card:nth-child(3) .feature-icon { background: #fef3c7; }
    .feature-card:nth-child(4) .feature-icon { background: #fce7f3; }

    .feature-card h3 {
        font-size: 1.2rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    /* Contact Section */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        align-items: start;
    }

    .contact-info {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-icon {
        width: 50px;
        height: 50px;
        background: #d1fae5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .contact-detail h4 {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .contact-detail p {
        font-size: 1.1rem;
        color: #1f2937;
        font-weight: 500;
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: white;
        width: 100%;
        justify-content: center;
        margin-top: 1.5rem;
        font-size: 1.1rem;
        padding: 1rem 2rem;
    }

    .btn-whatsapp:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
    }

    /* Registration Form */
    .form-container {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-header h2 {
        font-size: 1.8rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: #6b7280;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group label .required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        outline: none;
        border-color: #10b981;
        background: white;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .file-upload {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-upload:hover {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .file-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .file-upload-text {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .file-upload-hint {
        font-size: 0.8rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        width: 100%;
        padding: 1.25rem 2rem;
        font-size: 1.1rem;
        border-radius: 12px;
        margin-top: 1.5rem;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.5);
    }

    /* Alert Messages */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #f87171;
    }

    .alert-icon {
        font-size: 1.5rem;
    }

    /* Error Messages */
    .error-message {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ppdb-hero h1 {
            font-size: 1.8rem;
        }

        .countdown-number {
            font-size: 1.8rem;
        }

        .countdown-item {
            min-width: 50px;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }

        .section {
            padding: 3rem 1rem;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .steps-container {
            flex-direction: column;
            align-items: center;
        }

        .step-item {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="ppdb-hero">
    <div class="ppdb-hero-content">
        <span class="ppdb-badge">● PENDAFTARAN DIBUKA!</span>
        
        <h1>PPDB <span>SD Negeri 7 Bangsri</span><br>Tahun Ajaran 2026/2027 Dibuka!</h1>
        
        <p class="ppdb-hero-subtitle">
            Daftarkan putra/putri Anda sekarang untuk masa depan yang lebih cerah 
        </p>

        <!-- Countdown Timer -->
        <div class="countdown-container">
            <p class="countdown-label">○ Pendaftaran Ditutup Dalam:</p>
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <span class="countdown-number" id="days">00</span>
                    <span class="countdown-text">Hari</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">00</span>
                    <span class="countdown-text">Jam</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">00</span>
                    <span class="countdown-text">Menit</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="seconds">00</span>
                    <span class="countdown-text">Detik</span>
                </div>
            </div>
        </div>

        <!-- Hero Buttons -->
        <div class="hero-buttons">
            <a href="#form-pendaftaran" class="btn btn-primary">
                ▶ Daftar Sekarang
            </a>
            <a href="#syarat-pendaftaran" class="btn btn-secondary">
                ▶ Lihat Syarat
            </a>
            <a href="{{ route('ppdb.download') }}" class="btn btn-outline">
                ▶ Download Formulir
            </a>
        </div>
    </div>
</section>

<!-- Section 1: Informasi PPDB -->
<section class="section section-alt" id="informasi-ppdb">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">◆ Informasi PPDB</h2>
            <p class="section-subtitle">Informasi lengkap mengenai penerimaan peserta didik baru</p>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-icon green">○</div>
                <h3>Tanggal Pendaftaran</h3>
                <p>1 Maret - 30 April 2026</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon yellow">○</div>
                <h3>Kuota Siswa</h3>
                <p>60 Siswa (2 Kelas)</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon blue">○</div>
                <h3>Jalur Pendaftaran</h3>
                <p>Zonasi & Prestasi</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon red">○</div>
                <h3>Sistem Seleksi</h3>
                <p>Verifikasi Dokumen</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Syarat Pendaftaran -->
<section class="section" id="syarat-pendaftaran">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">▶ Syarat Pendaftaran</h2>
            <p class="section-subtitle">Siapkan dokumen-dokumen berikut untuk mendaftar</p>
        </div>

        <div class="requirements-list">
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Fotokopi Kartu Keluarga (KK)</span>
            </div>
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Fotokopi Akta Kelahiran</span>
            </div>
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Pas Foto 3x4 (3 lembar)</span>
            </div>
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Mengisi Formulir Pendaftaran</span>
            </div>
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Usia minimal 6 tahun per Juli 2026</span>
            </div>
            <div class="requirement-item">
                <div class="requirement-icon">✓</div>
                <span class="requirement-text">Fotokopi KTP Orang Tua/Wali</span>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Alur Pendaftaran -->
<section class="section section-green" id="alur-pendaftaran">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">▶ Alur Pendaftaran</h2>
            <p class="section-subtitle">4 langkah mudah untuk mendaftarkan putra/putri Anda</p>
        </div>

        <div class="steps-container">
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-icon">▶</div>
                <h3 class="step-title">Isi Formulir Online</h3>
                <p class="step-desc">Lengkapi formulir pendaftaran di bawah dengan data yang benar</p>
            </div>
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-icon">○</div>
                <h3 class="step-title">Upload Dokumen</h3>
                <p class="step-desc">Unggah scan/foto dokumen persyaratan yang diminta</p>
            </div>
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-icon">○</div>
                <h3 class="step-title">Verifikasi Admin</h3>
                <p class="step-desc">Tim PPDB akan memverifikasi data dan dokumen Anda</p>
            </div>
            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-icon">●</div>
                <h3 class="step-title">Pengumuman Hasil</h3>
                <p class="step-desc">Hasil seleksi diumumkan via WhatsApp & website</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Kenapa Memilih Sekolah Ini -->
<section class="section" id="kenapa-kami">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">◆ Kenapa Memilih SD Negeri 7 Bangsri?</h2>
            <p class="section-subtitle">Keunggulan sekolah kami untuk putra/putri Anda</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">○</div>
                <h3>Guru Berpengalaman</h3>
                <p>Tenaga pengajar profesional dan bersertifikasi dengan pengalaman mengajar lebih dari 10 tahun</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">○</div>
                <h3>Lingkungan Aman</h3>
                <p>Lingkungan sekolah yang aman, nyaman, dan kondusif untuk kegiatan belajar mengajar</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">○</div>
                <h3>Ekstrakurikuler Lengkap</h3>
                <p>Berbagai kegiatan ekstrakurikuler: Pramuka, Olahraga, Seni, Komputer, dan lainnya</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">○</div>
                <h3>Prestasi Sekolah</h3>
                <p>Berbagai prestasi akademik dan non-akademik di tingkat kecamatan hingga kabupaten</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Form Pendaftaran -->
<section class="section section-alt" id="form-pendaftaran">
    <div class="section-container">
        <div class="contact-grid">
            <!-- Form Pendaftaran -->
            <div class="form-container">
                <div class="form-header">
                    <h2>▶ Formulir Pendaftaran PPDB</h2>
                    <p>Isi formulir dengan data yang benar dan lengkap</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <span class="alert-icon">○</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <span class="alert-icon">×</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-grid">
                        <!-- Nama Siswa -->
                        <div class="form-group">
                            <label for="student_name">
                                Nama Lengkap Siswa <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="student_name" 
                                   name="student_name" 
                                   class="form-control" 
                                   placeholder="Masukkan nama lengkap calon siswa"
                                   value="{{ old('student_name') }}"
                                   required>
                            @error('student_name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Orang Tua -->
                        <div class="form-group">
                            <label for="parent_name">
                                Nama Orang Tua/Wali <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="parent_name" 
                                   name="parent_name" 
                                   class="form-control" 
                                   placeholder="Masukkan nama orang tua/wali"
                                   value="{{ old('parent_name') }}"
                                   required>
                            @error('parent_name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="form-group">
                            <label for="nik">
                                NIK (Nomor Induk Kependudukan) <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="nik" 
                                   name="nik" 
                                   class="form-control" 
                                   placeholder="16 digit NIK siswa"
                                   value="{{ old('nik') }}"
                                   maxlength="16"
                                   pattern="[0-9]{16}"
                                   required>
                            @error('nik')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="place_of_birth">Tempat Lahir</label>
                            <input type="text" 
                                   id="place_of_birth" 
                                   name="place_of_birth" 
                                   class="form-control" 
                                   placeholder="Kota/Kabupaten kelahiran"
                                   value="{{ old('place_of_birth') }}">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="date_of_birth">Tanggal Lahir</label>
                            <input type="date" 
                                   id="date_of_birth" 
                                   name="date_of_birth" 
                                   class="form-control"
                                   value="{{ old('date_of_birth') }}">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- No. HP -->
                        <div class="form-group">
                            <label for="phone">No. HP/WhatsApp</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form-control" 
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('phone') }}">
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="email@contoh.com"
                                   value="{{ old('email') }}">
                        </div>

                        <!-- Alamat -->
                        <div class="form-group full-width">
                            <label for="address">Alamat Lengkap</label>
                            <textarea id="address" 
                                      name="address" 
                                      class="form-control" 
                                      placeholder="Masukkan alamat lengkap sesuai KK">{{ old('address') }}</textarea>
                        </div>

                        <!-- Upload KK -->
                        <div class="form-group">
                            <label>
                                Upload Kartu Keluarga <span class="required">*</span>
                            </label>
                            <div class="file-upload">
                                <input type="file" 
                                       name="kk_file" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       required>
                                <div class="file-upload-icon">○</div>
                                <p class="file-upload-text">Klik atau drag file KK</p>
                                <p class="file-upload-hint">PDF, JPG, PNG (Max 2MB)</p>
                            </div>
                            @error('kk_file')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Akta -->
                        <div class="form-group">
                            <label>
                                Upload Akta Kelahiran <span class="required">*</span>
                            </label>
                            <div class="file-upload">
                                <input type="file" 
                                       name="akta_file" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       required>
                                <div class="file-upload-icon">○</div>
                                <p class="file-upload-text">Klik atau drag file Akta</p>
                                <p class="file-upload-hint">PDF, JPG, PNG (Max 2MB)</p>
                            </div>
                            @error('akta_file')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Foto -->
                        <div class="form-group full-width">
                            <label>Upload Pas Foto 3x4 (Opsional)</label>
                            <div class="file-upload">
                                <input type="file" 
                                       name="photo_file" 
                                       accept=".jpg,.jpeg,.png">
                                <div class="file-upload-icon">○</div>
                                <p class="file-upload-text">Klik atau drag foto</p>
                                <p class="file-upload-hint">JPG, PNG (Max 1MB)</p>
                            </div>
                            @error('photo_file')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group full-width">
                            <button type="submit" class="btn btn-submit">
                                ▶ Kirim Pendaftaran
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Kontak Panitia -->
            <div class="contact-info">
                <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 1.5rem;">◆ Kontak Panitia PPDB</h3>
                
                <div class="contact-item">
                    <div class="contact-icon">○</div>
                    <div class="contact-detail">
                        <h4>WhatsApp</h4>
                        <p>0812-3456-7890</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">◆</div>
                    <div class="contact-detail">
                        <h4>Email</h4>
                        <p>ppdb@sdn7bangsri.sch.id</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">◆</div>
                    <div class="contact-detail">
                        <h4>Alamat Sekolah</h4>
                        <p>{{ $profile->address ?? 'Jl. Raya Bangsri No. 7, Jepara' }}</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">○</div>
                    <div class="contact-detail">
                        <h4>Jam Pelayanan</h4>
                        <p>Senin - Jumat: 08:00 - 14:00 WIB</p>
                    </div>
                </div>

                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20PPDB%20SDN%207%20Bangsri" 
                   class="btn btn-whatsapp"
                   target="_blank">
                    ▶ Chat WhatsApp Sekarang
                </a>

                <!-- Info Tambahan -->
                <div style="margin-top: 2rem; padding: 1.5rem; background: #f0fdf4; border-radius: 12px; border-left: 4px solid #10b981;">
                    <h4 style="color: #065f46; margin-bottom: 0.5rem;">○ Tips Pendaftaran</h4>
                    <ul style="color: #047857; font-size: 0.9rem; padding-left: 1.2rem; margin: 0;">
                        <li>Pastikan dokumen jelas dan tidak buram</li>
                        <li>NIK harus sesuai dengan Akta Kelahiran</li>
                        <li>Simpan bukti pendaftaran untuk keperluan verifikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Countdown Timer
    function updateCountdown() {
        // Set tanggal penutupan PPDB (30 April 2026)
        const deadline = new Date('2026-04-30T23:59:59').getTime();
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance < 0) {
            document.getElementById('countdown').innerHTML = '<p style="font-size: 1.2rem; color: #dc2626;">Pendaftaran Telah Ditutup</p>';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }

    // Update countdown setiap detik
    setInterval(updateCountdown, 1000);
    updateCountdown();

    // File upload preview
    document.querySelectorAll('.file-upload input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            const uploadText = this.parentElement.querySelector('.file-upload-text');
            if (fileName && uploadText) {
                uploadText.textContent = fileName;
                this.parentElement.style.borderColor = '#10b981';
                this.parentElement.style.background = '#f0fdf4';
            }
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // NIK input validation (numbers only)
    document.getElementById('nik')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
    });
</script>
@endsection



