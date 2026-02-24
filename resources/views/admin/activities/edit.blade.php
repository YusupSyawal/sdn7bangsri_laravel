@extends('admin.layout.app')

@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')
@section('page-subtitle', 'Ubah data kegiatan')

@section('styles')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 900px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2d3748;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    textarea.form-control {
        min-height: 200px;
        resize: vertical;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check input {
        width: 20px;
        height: 20px;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #4a5568;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #cbd5e0;
    }

    .invalid-feedback {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .current-image {
        max-width: 300px;
        margin-top: 0.5rem;
        border-radius: 8px;
    }

    .preview-image {
        max-width: 300px;
        margin-top: 1rem;
        border-radius: 8px;
        display: none;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Kegiatan *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $activity->title) }}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date">Tanggal Kegiatan</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $activity->date ? $activity->date->format('Y-m-d') : '') }}">
            @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Kegiatan *</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $activity->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Gambar Kegiatan</label>
            @if($activity->image)
                <div>
                    <img src="{{ asset('storage/' . $activity->image) }}" class="current-image" alt="{{ $activity->title }}">
                    <p style="color:#718096;font-size:0.875rem;margin-top:0.5rem;">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(this)" style="margin-top:1rem;">
            <img id="imagePreview" class="preview-image">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $activity->is_active) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan di website</label>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-submit">💾 Update Kegiatan</button>
            <a href="{{ route('admin.activities.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
