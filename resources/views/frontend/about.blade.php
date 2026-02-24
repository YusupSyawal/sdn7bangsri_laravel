@extends('frontend.layout.app')

@section('title', 'Tentang Kami - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .about-hero h1 {
        font-size: 2.5rem;
        color: #1a5c3d;
        margin-bottom: 1rem;
    }

    .about-hero p {
        font-size: 1.2rem;
        color: #2d3748;
        max-width: 600px;
        margin: 0 auto;
    }

    .about-content {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .about-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .about-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .about-card:hover {
        transform: translateY(-5px);
    }

    .about-card h3 {
        color: #1a5c3d;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .about-card p {
        color: #4a5568;
        line-height: 1.8;
    }

    .vision-mission {
        background: #f7fafc;
        padding: 4rem 2rem;
    }

    .vision-mission .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .vm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .vm-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        border-left: 5px solid #10b981;
    }

    .vm-card h3 {
        color: #1a5c3d;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<section class="about-hero">
    <h1>◆ Tentang SD Negeri 7 Bangsri</h1>
    <p>{{ $profile->welcome_message ?? 'Selamat datang di SD Negeri 7 Bangsri' }}</p>
</section>

<section class="vision-mission">
    <div class="container">
        <div class="vm-grid">
            <div class="vm-card">
                <h3>▶ Visi</h3>
                <p>{{ $profile->vision ?? 'Visi sekolah belum diisi' }}</p>
            </div>
            <div class="vm-card">
                <h3>▶ Misi</h3>
                <p>{{ $profile->mission ?? 'Misi sekolah belum diisi' }}</p>
            </div>
        </div>
    </div>
</section>

<section class="about-content">
    <div class="about-grid">
        <div class="about-card">
            <h3>◆ Nilai-Nilai Kami</h3>
            <p>{{ $profile->values ?? 'Nilai-nilai sekolah belum diisi' }}</p>
        </div>
        <div class="about-card">
            <h3>◆ Pendekatan Kami</h3>
            <p>{{ $profile->approach ?? 'Pendekatan pembelajaran belum diisi' }}</p>
        </div>
    </div>
</section>
@endsection
