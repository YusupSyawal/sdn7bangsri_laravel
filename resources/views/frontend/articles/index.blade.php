@extends('frontend.layout.app')

@section('title', 'Artikel & Jurnal - SD Negeri 7 Bangsri')

@section('styles')
<style>
    .articles-hero {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        padding: 4rem 2rem;
        text-align: center;
    }

    .articles-hero h1 {
        font-size: 2.5rem;
        color: #1e40af;
        margin-bottom: 1rem;
    }

    .articles-hero p {
        font-size: 1.2rem;
        color: #1e3a8a;
    }

    .articles-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
    }

    .article-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        border-left: 4px solid transparent;
    }

    .article-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        border-left-color: #3b82f6;
    }

    .article-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .article-card-image-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #3b82f6;
    }

    .article-card-content {
        padding: 1.5rem;
    }

    .article-card-date {
        font-size: 0.85rem;
        color: #3b82f6;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .article-card-title {
        font-size: 1.2rem;
        color: #1f2937;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .btn-read {
        color: #3b82f6;
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
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    .pagination li.active span {
        background: #3b82f6;
        color: white;
    }

    .pagination li.disabled span {
        background: #f3f4f6;
        color: #9ca3af;
    }

    .no-articles {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
        grid-column: 1 / -1;
    }

    .no-articles .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<section class="articles-hero">
    <h1>◆ Artikel & Jurnal</h1>
    <p>Kumpulan artikel dan jurnal pendidikan SD Negeri 7 Bangsri</p>
</section>

<div class="articles-container">
    <div class="articles-grid">
        @forelse($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="article-card">
            @if($article->image)
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-card-image">
            @else
                <div class="article-card-image-placeholder">○</div>
            @endif

            <div class="article-card-content">
                <div class="article-card-date">○ {{ $article->formatted_date }}</div>
                <h3 class="article-card-title">{{ $article->title }}</h3>
            </div>

            <div class="article-card-footer">
                <span class="btn-read">Baca Artikel ▶</span>
            </div>
        </a>
        @empty
        <div class="no-articles">
            <div class="icon">○</div>
            <h3>Belum Ada Artikel</h3>
            <p>Artikel dan jurnal akan segera ditampilkan di sini.</p>
        </div>
        @endforelse
    </div>

    @if($articles->hasPages())
    <div class="pagination-container">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
