@extends('frontend.layout.app')

@section('title', 'Berita Sekolah - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .posts-hero {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .posts-hero h1 {
        font-size: 2.5rem;
        color: #1a5c3d;
        margin-bottom: 1rem;
    }

    .posts-hero p {
        font-size: 1.2rem;
        color: #166534;
    }

    .posts-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
    }

    .post-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .post-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .post-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .post-card-image-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #10b981;
    }

    .post-card-content {
        padding: 1.5rem;
    }

    .post-card-date {
        font-size: 0.85rem;
        color: #10b981;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .post-card-title {
        font-size: 1.2rem;
        color: #1f2937;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-card-excerpt {
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .btn-read {
        color: #10b981;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .pagination li a {
        background: white;
        color: #1f2937;
        border: 1px solid #e5e7eb;
    }

    .pagination li a:hover {
        background: #10b981;
        color: white;
        border-color: #10b981;
    }

    .pagination li.active span {
        background: #10b981;
        color: white;
    }

    .pagination li.disabled span {
        background: #f3f4f6;
        color: #9ca3af;
    }

    .no-posts {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
        grid-column: 1 / -1;
    }

    .no-posts .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<section class="posts-hero">
    <h1>◆ Berita Sekolah</h1>
    <p>Informasi dan berita terbaru seputar kegiatan SD Negeri 7 Bangsri</p>
</section>

<div class="posts-container">
    <div class="posts-grid">
        @forelse($posts as $post)
        <a href="{{ route('posts.show', $post->slug) }}" class="post-card">
            @if($post->image)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-card-image">
            @else
                <div class="post-card-image-placeholder">○</div>
            @endif

            <div class="post-card-content">
                <div class="post-card-date">○ {{ $post->formatted_date }}</div>
                <h3 class="post-card-title">{{ $post->title }}</h3>
                <p class="post-card-excerpt">{{ $post->excerpt }}</p>
            </div>

            <div class="post-card-footer">
                <span class="btn-read">Baca Selengkapnya ▶</span>
            </div>
        </a>
        @empty
        <div class="no-posts">
            <div class="icon">○</div>
            <h3>Belum Ada Berita</h3>
            <p>Berita sekolah akan segera ditampilkan di sini.</p>
        </div>
        @endforelse
    </div>

    @if($posts->hasPages())
    <div class="pagination-container">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
