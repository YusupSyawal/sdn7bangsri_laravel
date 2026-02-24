@extends('frontend.layout.app')

@section('title', 'Galeri - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .gallery-hero {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .gallery-hero h1 {
        font-size: 2.5rem;
        color: #991b1b;
        margin-bottom: 1rem;
    }

    .gallery-hero p {
        font-size: 1.2rem;
        color: #7f1d1d;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-item {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: scale(1.03);
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 1.5rem;
        transform: translateY(100%);
        transition: transform 0.3s;
    }

    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }

    .gallery-overlay h3 {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .gallery-overlay p {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .no-gallery {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
        grid-column: 1 / -1;
    }

    .gallery-placeholder {
        width: 100%;
        height: 250px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }
</style>
@endsection

@section('content')
<section class="gallery-hero">
    <h1>◆ Galeri Foto</h1>
    <p>Momen-momen berharga di SD Negeri 7 Bangsri</p>
</section>

<div class="gallery-grid">
    @forelse($galleries as $gallery)
    <div class="gallery-item">
        @if($gallery->image)
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}">
        @else
            <div class="gallery-placeholder">□</div>
        @endif
        <div class="gallery-overlay">
            <h3>{{ $gallery->title }}</h3>
            @if($gallery->description)
                <p>{{ Str::limit($gallery->description, 80) }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="no-gallery">
        <p>Belum ada foto di galeri.</p>
    </div>
    @endforelse
</div>
@endsection
