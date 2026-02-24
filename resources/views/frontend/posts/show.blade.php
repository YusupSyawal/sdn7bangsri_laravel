@extends('frontend.layout.app')

@section('title', $post->title . ' - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .post-detail-hero {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        padding: 3rem 2rem;
    }

    .post-detail-hero .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .breadcrumb a {
        color: #166534;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb span {
        color: #64748b;
    }

    .post-detail-hero h1 {
        font-size: 2.2rem;
        color: #1f2937;
        line-height: 1.4;
        margin-bottom: 1rem;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        color: #166534;
        font-size: 0.95rem;
    }

    .post-meta-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .post-content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .post-featured-image {
        width: 100%;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    .post-content {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #374151;
    }

    .post-content p {
        margin-bottom: 1.5rem;
    }

    .post-content h2 {
        font-size: 1.5rem;
        color: #1f2937;
        margin: 2rem 0 1rem;
    }

    .post-content h3 {
        font-size: 1.3rem;
        color: #1f2937;
        margin: 1.5rem 0 1rem;
    }

    .post-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .post-content ul, .post-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
    }

    .post-content li {
        margin-bottom: 0.5rem;
    }

    /* Related Posts */
    .related-posts {
        background: #f8fafc;
        padding: 3rem 2rem;
    }

    .related-posts-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .related-posts h2 {
        font-size: 1.5rem;
        color: #1f2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    .related-posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .related-post-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }

    .related-post-card:hover {
        transform: translateY(-5px);
    }

    .related-post-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .related-post-card-placeholder {
        width: 100%;
        height: 160px;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #10b981;
    }

    .related-post-card-content {
        padding: 1rem;
    }

    .related-post-card-content h4 {
        font-size: 1rem;
        color: #1f2937;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-post-card-content .date {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2rem;
        padding: 0.75rem 1.5rem;
        background: #1a5c3d;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #166534;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<section class="post-detail-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span>▶</span>
            <a href="{{ route('posts.index') }}">Berita</a>
            <span>▶</span>
            <span>{{ Str::limit($post->title, 40) }}</span>
        </nav>

        <h1>{{ $post->title }}</h1>

        <div class="post-meta">
            <div class="post-meta-item">
                <span>○</span>
                <span>{{ $post->formatted_date }}</span>
            </div>
        </div>
    </div>
</section>

<div class="post-content-wrapper">
    @if($post->image)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-featured-image">
    @endif

    <div class="post-content">
        {!! nl2br(e($post->content)) !!}
    </div>

    <a href="{{ route('posts.index') }}" class="btn-back">
        ◀ Kembali ke Berita
    </a>
</div>

@if($relatedPosts->count() > 0)
<section class="related-posts">
    <div class="related-posts-container">
        <h2>◆ Berita Lainnya</h2>

        <div class="related-posts-grid">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related->slug) }}" class="related-post-card">
                @if($related->image)
                    <img src="{{ $related->image_url }}" alt="{{ $related->title }}">
                @else
                    <div class="related-post-card-placeholder">○</div>
                @endif

                <div class="related-post-card-content">
                    <h4>{{ $related->title }}</h4>
                    <div class="date">{{ $related->formatted_date }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
