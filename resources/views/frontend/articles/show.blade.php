@extends('frontend.layout.app')

@section('title', $article->title . ' - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .article-detail-hero {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        padding: 3rem 2rem;
    }

    .article-detail-hero .container {
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
        color: #1e40af;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb span {
        color: #64748b;
    }

    .article-detail-hero h1 {
        font-size: 2.2rem;
        color: #1f2937;
        line-height: 1.4;
        margin-bottom: 1rem;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        color: #1e40af;
        font-size: 0.95rem;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .article-content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .article-featured-image {
        width: 100%;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #374151;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content h2 {
        font-size: 1.5rem;
        color: #1f2937;
        margin: 2rem 0 1rem;
    }

    .article-content h3 {
        font-size: 1.3rem;
        color: #1f2937;
        margin: 1.5rem 0 1rem;
    }

    .article-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .article-content ul, .article-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    /* Related Articles */
    .related-articles {
        background: #f8fafc;
        padding: 3rem 2rem;
    }

    .related-articles-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .related-articles h2 {
        font-size: 1.5rem;
        color: #1f2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    .related-articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .related-article-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }

    .related-article-card:hover {
        transform: translateY(-5px);
        border-left-color: #3b82f6;
    }

    .related-article-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .related-article-card-placeholder {
        width: 100%;
        height: 160px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #3b82f6;
    }

    .related-article-card-content {
        padding: 1rem;
    }

    .related-article-card-content h4 {
        font-size: 1rem;
        color: #1f2937;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-article-card-content .date {
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
        background: #1e40af;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #1e3a8a;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<section class="article-detail-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span>▶</span>
            <a href="{{ route('articles.index') }}">Artikel</a>
            <span>▶</span>
            <span>{{ Str::limit($article->title, 40) }}</span>
        </nav>

        <h1>{{ $article->title }}</h1>

        <div class="article-meta">
            <div class="article-meta-item">
                <span>○</span>
                <span>{{ $article->formatted_date }}</span>
            </div>
        </div>
    </div>
</section>

<div class="article-content-wrapper">
    @if($article->image)
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-featured-image">
    @endif

    <div class="article-content">
        {!! nl2br(e($article->content ?? 'Konten artikel belum tersedia.')) !!}
    </div>

    <a href="{{ route('articles.index') }}" class="btn-back">
        ◀ Kembali ke Artikel
    </a>
</div>

@if($relatedArticles->count() > 0)
<section class="related-articles">
    <div class="related-articles-container">
        <h2>◆ Artikel Lainnya</h2>

        <div class="related-articles-grid">
            @foreach($relatedArticles as $related)
            <a href="{{ route('articles.show', $related->slug) }}" class="related-article-card">
                @if($related->image)
                    <img src="{{ $related->image_url }}" alt="{{ $related->title }}">
                @else
                    <div class="related-article-card-placeholder">○</div>
                @endif

                <div class="related-article-card-content">
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
