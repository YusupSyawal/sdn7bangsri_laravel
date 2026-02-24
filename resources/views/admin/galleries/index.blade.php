@extends('admin.layout.app')

@section('title', 'Kelola Galeri')
@section('page-title', 'Galeri Foto')
@section('page-subtitle', 'Kelola foto galeri sekolah')

@section('styles')
<style>
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-add {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .gallery-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .gallery-image-container {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s;
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
        opacity: 0;
        transition: all 0.3s;
        display: flex;
        align-items: flex-end;
        padding: 1rem;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-info {
        padding: 1rem;
    }

    .gallery-title {
        font-size: 1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }

    .gallery-caption {
        color: #718096;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .gallery-actions {
        padding: 0 1rem 1rem;
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        flex: 1;
        padding: 0.5rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
    }

    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-edit:hover {
        background: #fde68a;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-delete:hover {
        background: #fecaca;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #718096;
        grid-column: 1 / -1;
        background: white;
        border-radius: 12px;
    }

    .empty-state .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .placeholder-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }
</style>
@endsection

@section('content')
<div class="toolbar">
    <h2>Galeri Foto ({{ $galleries->count() }})</h2>
    <a href="{{ route('admin.galleries.create') }}" class="btn-add">
        ➕ Tambah Foto
    </a>
</div>

<div class="gallery-grid">
    @forelse($galleries as $gallery)
    <div class="gallery-card">
        <div class="gallery-image-container">
            @if($gallery->image)
                <img src="{{ asset('storage/' . $gallery->image) }}" class="gallery-image" alt="{{ $gallery->title }}">
            @else
                <div class="placeholder-image">🖼️</div>
            @endif
            <div class="gallery-overlay">
                <span style="color:white;font-size:0.9rem;">{{ $gallery->title }}</span>
            </div>
        </div>
        <div class="gallery-info">
            <h3 class="gallery-title">{{ Str::limit($gallery->title, 30) }}</h3>
            @if($gallery->caption)
                <p class="gallery-caption">{{ Str::limit($gallery->caption, 50) }}</p>
            @endif
            @if($gallery->is_active)
                <span class="badge badge-success">Aktif</span>
            @else
                <span class="badge badge-danger">Nonaktif</span>
            @endif
        </div>
        <div class="gallery-actions">
            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn-edit">✏️ Edit</a>
            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" style="width:100%;">🗑️ Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="icon">📷</div>
        <p>Belum ada foto di galeri. Tambahkan foto pertama!</p>
    </div>
    @endforelse
</div>
@endsection
