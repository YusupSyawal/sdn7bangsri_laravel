@extends('admin.layout.app')

@section('title', 'Tambah Foto')
@section('page-title', 'Tambah Foto Galeri')
@section('page-subtitle', 'Tambahkan foto baru ke galeri')

@section('styles')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 800px;
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

    .preview-image {
        max-width: 400px;
        margin-top: 1rem;
        border-radius: 8px;
        display: none;
    }

    .upload-area {
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .upload-area .icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .upload-area input[type="file"] {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Judul Foto *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan judul foto" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="caption">Keterangan (Opsional)</label>
            <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption" rows="3" placeholder="Tambahkan keterangan foto">{{ old('caption') }}</textarea>
            @error('caption')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar *</label>
            <div class="upload-area" onclick="document.getElementById('image').click()">
                <div class="icon">📷</div>
                <p>Klik untuk memilih gambar atau drop file di sini</p>
                <p style="color:#718096;font-size:0.85rem;">Format: JPG, PNG, GIF. Max: 2MB</p>
            </div>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(this)" required>
            <img id="imagePreview" class="preview-image">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan di website</label>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-submit">💾 Simpan Foto</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const uploadArea = document.querySelector('.upload-area');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            uploadArea.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
