@extends('admin.layout.app')

@section('title', 'Kelola Guru')
@section('page-title', 'Data Guru')
@section('page-subtitle', 'Kelola data guru dan tenaga pendidik')

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

    .teacher-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .teacher-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }

    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .teacher-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #e2e8f0;
    }

    .teacher-info {
        padding: 1.5rem;
    }

    .teacher-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }

    .teacher-position {
        color: #10b981;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .teacher-nip {
        color: #718096;
        font-size: 0.85rem;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
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

    .teacher-actions {
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
    <h2>Daftar Guru ({{ $teachers->count() }})</h2>
    <a href="{{ route('admin.teachers.create') }}" class="btn-add">
        ➕ Tambah Guru
    </a>
</div>

<div class="teacher-grid">
    @forelse($teachers as $teacher)
    <div class="teacher-card">
        @if($teacher->photo)
            <img src="{{ asset('storage/' . $teacher->photo) }}" class="teacher-image" alt="{{ $teacher->name }}">
        @else
            <div class="placeholder-image">👤</div>
        @endif
        <div class="teacher-info">
            <h3 class="teacher-name">{{ $teacher->name }}</h3>
            <p class="teacher-position">{{ $teacher->subject }}</p>
            @if($teacher->specialty)
                <p class="teacher-nip">{{ $teacher->specialty }}</p>
            @endif
            @if($teacher->experience)
                <p class="teacher-nip">{{ $teacher->experience }} tahun pengalaman</p>
            @endif
            @if($teacher->is_active)
                <span class="badge badge-success">Aktif</span>
            @else
                <span class="badge badge-danger">Nonaktif</span>
            @endif
        </div>
        <div class="teacher-actions">
            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn-edit">✏️ Edit</a>
            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" style="width:100%;">🗑️ Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="icon">👨‍🏫</div>
        <p>Belum ada data guru. Tambahkan guru pertama!</p>
    </div>
    @endforelse
</div>
@endsection
