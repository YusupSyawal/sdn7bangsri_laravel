@extends('admin.layout.app')

@section('title', 'Kelola Kegiatan')
@section('page-title', 'Kegiatan Sekolah')
@section('page-subtitle', 'Kelola kegiatan dan berita sekolah')

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

    .activity-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .activity-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }

    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .activity-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background: #e2e8f0;
    }

    .activity-info {
        padding: 1.5rem;
    }

    .activity-date {
        color: #10b981;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .activity-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .activity-excerpt {
        color: #718096;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .activity-actions {
        padding: 0 1.5rem 1.5rem;
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        flex: 1;
        padding: 0.5rem;
        border-radius: 6px;
        font-size: 0.85rem;
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
        height: 180px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    @media (max-width: 600px) {
        .activity-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="toolbar">
    <h2>Daftar Kegiatan ({{ $activities->count() }})</h2>
    <a href="{{ route('admin.activities.create') }}" class="btn-add">
        ➕ Tambah Kegiatan
    </a>
</div>

<div class="activity-grid">
    @forelse($activities as $activity)
    <div class="activity-card">
        @if($activity->image)
            <img src="{{ asset('storage/' . $activity->image) }}" class="activity-image" alt="{{ $activity->title }}">
        @else
            <div class="placeholder-image">📰</div>
        @endif
        <div class="activity-info">
            <div class="activity-date">
                📅 {{ $activity->date ? $activity->date->format('d M Y') : $activity->created_at->format('d M Y') }}
            </div>
            <h3 class="activity-title">{{ $activity->title }}</h3>
            <p class="activity-excerpt">{{ Str::limit(strip_tags($activity->description), 100) }}</p>
            @if($activity->is_active)
                <span class="badge badge-success">Aktif</span>
            @else
                <span class="badge badge-danger">Nonaktif</span>
            @endif
        </div>
        <div class="activity-actions">
            <a href="{{ route('admin.activities.edit', $activity) }}" class="btn-edit">✏️ Edit</a>
            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" style="width:100%;">🗑️ Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="icon">📰</div>
        <p>Belum ada kegiatan. Tambahkan kegiatan pertama!</p>
    </div>
    @endforelse
</div>
@endsection
