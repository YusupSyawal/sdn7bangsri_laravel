@extends('frontend.layout.app')

@section('title', 'Kegiatan - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .activities-hero {
        background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .activities-hero h1 {
        font-size: 2.5rem;
        color: #1e40af;
        margin-bottom: 1rem;
    }

    .activities-hero p {
        font-size: 1.2rem;
        color: #1e3a8a;
    }

    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .activity-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .activity-card:hover {
        transform: translateY(-10px);
    }

    .activity-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #c7d2fe 0%, #a5b4fc 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .activity-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .activity-content {
        padding: 1.5rem;
    }

    .activity-content h3 {
        color: #1a202c;
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
    }

    .activity-content p {
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .activity-date {
        color: #10b981;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .no-activities {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
        grid-column: 1 / -1;
    }
</style>
@endsection

@section('content')
<section class="activities-hero">
    <h1>◆ Kegiatan Sekolah</h1>
    <p>Berbagai kegiatan yang menyenangkan dan edukatif</p>
</section>

<div class="activities-grid">
    @forelse($activities as $activity)
    <div class="activity-card">
        <div class="activity-image">
            @if($activity->image)
                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}">
            @else
                ○
            @endif
        </div>
        <div class="activity-content">
            <h3>{{ $activity->title }}</h3>
            <p>{{ Str::limit($activity->description, 150) }}</p>
            @if($activity->date)
                <span class="activity-date">▶ {{ $activity->date->format('d M Y') }}</span>
            @elseif($activity->category)
                <span class="activity-date">▶ {{ $activity->category }}</span>
            @endif
        </div>
    </div>
    @empty
    <div class="no-activities">
        <p>Belum ada kegiatan yang ditambahkan.</p>
    </div>
    @endforelse
</div>
@endsection
