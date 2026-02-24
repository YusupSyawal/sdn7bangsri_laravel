@extends('frontend.layout.app')

@section('title', 'Guru & Staff - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .teachers-hero {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .teachers-hero h1 {
        font-size: 2.5rem;
        color: #92400e;
        margin-bottom: 1rem;
    }

    .teachers-hero p {
        font-size: 1.2rem;
        color: #78350f;
    }

    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .teacher-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .teacher-card:hover {
        transform: translateY(-10px);
    }

    .teacher-photo {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    .teacher-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .teacher-info {
        padding: 1.5rem;
        text-align: center;
    }

    .teacher-info h3 {
        color: #1a202c;
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .teacher-info .position {
        color: #10b981;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .teacher-info .nip {
        color: #718096;
        font-size: 0.9rem;
    }

    .no-teachers {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
    }
</style>
@endsection

@section('content')
<section class="teachers-hero">
    <h1>◆ Guru & Staff</h1>
    <p>Tenaga pendidik yang berdedikasi untuk masa depan anak-anak</p>
</section>

<div class="teachers-grid">
    @forelse($teachers as $teacher)
    <div class="teacher-card">
        <div class="teacher-photo">
            @if($teacher->photo)
                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}">
            @else
                ○
            @endif
        </div>
        <div class="teacher-info">
            <h3>{{ $teacher->name }}</h3>
            <p class="position">{{ $teacher->subject }}</p>
            @if($teacher->specialty)
                <p class="nip">{{ $teacher->specialty }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="no-teachers">
        <p>Belum ada data guru yang ditambahkan.</p>
    </div>
    @endforelse
</div>
@endsection
