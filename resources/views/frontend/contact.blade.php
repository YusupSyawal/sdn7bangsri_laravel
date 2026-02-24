@extends('frontend.layout.app')

@section('title', 'Kontak - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #d8b4fe 0%, #c084fc 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .contact-hero h1 {
        font-size: 2.5rem;
        color: #581c87;
        margin-bottom: 1rem;
    }

    .contact-hero p {
        font-size: 1.2rem;
        color: #6b21a8;
    }

    .contact-content {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .contact-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s;
    }

    .contact-card:hover {
        transform: translateY(-5px);
    }

    .contact-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .contact-card h3 {
        color: #1a202c;
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
    }

    .contact-card p {
        color: #4a5568;
        line-height: 1.6;
    }

    .contact-card a {
        color: #10b981;
        text-decoration: none;
        font-weight: 600;
    }

    .contact-card a:hover {
        text-decoration: underline;
    }

    .map-section {
        background: #f7fafc;
        padding: 4rem 2rem;
    }

    .map-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .map-container h2 {
        text-align: center;
        color: #1a202c;
        margin-bottom: 2rem;
        font-size: 1.8rem;
    }

    .map-placeholder {
        background: white;
        height: 400px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        font-size: 1.2rem;
        color: #718096;
    }

    .school-hours {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        padding: 3rem 2rem;
        text-align: center;
    }

    .school-hours h2 {
        color: #1a5c3d;
        margin-bottom: 1rem;
    }

    .school-hours p {
        color: #166534;
        font-size: 1.1rem;
    }
</style>
@endsection

@section('content')
<section class="contact-hero">
    <h1>◆ Hubungi Kami</h1>
    <p>Kami senang mendengar dari Anda</p>
</section>

<section class="contact-content">
    <div class="contact-grid">
        <div class="contact-card">
            <div class="contact-icon">◆</div>
            <h3>Alamat</h3>
            <p>{{ $profile->address ?? 'Alamat belum diisi' }}</p>
        </div>

        <div class="contact-card">
            <div class="contact-icon">◆</div>
            <h3>Email</h3>
            <p><a href="mailto:{{ $profile->email ?? '' }}">{{ $profile->email ?? 'Email belum diisi' }}</a></p>
        </div>

        <div class="contact-card">
            <div class="contact-icon">◆</div>
            <h3>Telepon</h3>
            <p><a href="tel:{{ $profile->phone ?? '' }}">{{ $profile->phone ?? 'Telepon belum diisi' }}</a></p>
        </div>
    </div>
</section>

<section class="school-hours">
    <h2>▶ Jam Sekolah</h2>
    <p>{{ $profile->school_hours ?? 'Jam sekolah belum diisi' }}</p>
</section>

<section class="map-section">
    <div class="map-container">
        <h2>◆ Lokasi Kami</h2>
        <div class="map-placeholder">
            <p>□ Peta lokasi akan ditampilkan di sini</p>
        </div>
    </div>
</section>
@endsection
