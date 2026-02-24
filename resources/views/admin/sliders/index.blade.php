@extends('admin.layout.app')

@section('title', 'Kelola Slider')
@section('page-title', 'Hero Slider')
@section('page-subtitle', 'Kelola gambar slider di halaman utama')

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

    .data-table {
        width: 100%;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .data-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #f7fafc;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #2d3748;
        border-bottom: 2px solid #e2e8f0;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #f7fafc;
        vertical-align: middle;
    }

    .data-table tr:hover {
        background: #f7fafc;
    }

    .data-table img {
        width: 120px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
    }

    .badge {
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

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
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
    }

    .empty-state .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .data-table {
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="toolbar">
    <h2>Daftar Slider</h2>
    <a href="{{ route('admin.sliders.create') }}" class="btn-add">
        ➕ Tambah Slider
    </a>
</div>

<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Subtitle</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sliders as $slider)
            <tr>
                <td>
                    @if($slider->image)
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}">
                    @else
                        <div style="width:120px;height:70px;background:#e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">🖼️</div>
                    @endif
                </td>
                <td><strong>{{ $slider->title }}</strong></td>
                <td>{{ Str::limit($slider->subtitle, 50) }}</td>
                <td>{{ $slider->order }}</td>
                <td>
                    @if($slider->is_active)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">🗑️ Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="icon">🖼️</div>
                        <p>Belum ada slider. Tambahkan slider pertama!</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
