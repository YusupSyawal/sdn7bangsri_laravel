@extends('admin.layout.app')

@section('title', 'Edit Profil Sekolah')
@section('page-title', 'Profil Sekolah')
@section('page-subtitle', 'Kelola informasi profil sekolah')

@section('styles')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 900px;
    }

    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .form-section h3 {
        color: #2d3748;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
        min-height: 120px;
        resize: vertical;
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
        max-width: 200px;
        margin: 0.5rem 0;
        border-radius: 8px;
    }

    .preview-image {
        max-width: 200px;
        margin-top: 1rem;
        border-radius: 8px;
        display: none;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 600px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .hint {
        color: #718096;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Sekolah -->
        <div class="form-section">
            <h3>🏫 Informasi Sekolah</h3>

            <div class="form-group">
                <label for="name">Nama Sekolah *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $profile->name ?? '') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="npsn">NPSN</label>
                    <input type="text" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" value="{{ old('npsn', $profile->npsn ?? '') }}">
                    @error('npsn')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="accreditation">Akreditasi</label>
                    <select class="form-control @error('accreditation') is-invalid @enderror" id="accreditation" name="accreditation">
                        <option value="">Pilih Akreditasi</option>
                        <option value="A" {{ old('accreditation', $profile->accreditation ?? '') == 'A' ? 'selected' : '' }}>A (Unggul)</option>
                        <option value="B" {{ old('accreditation', $profile->accreditation ?? '') == 'B' ? 'selected' : '' }}>B (Baik)</option>
                        <option value="C" {{ old('accreditation', $profile->accreditation ?? '') == 'C' ? 'selected' : '' }}>C (Cukup)</option>
                    </select>
                    @error('accreditation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Sekolah</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Tulis deskripsi singkat tentang sekolah...">{{ old('description', $profile->description ?? '') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="vision">Visi</label>
                <textarea class="form-control @error('vision') is-invalid @enderror" id="vision" name="vision" placeholder="Visi sekolah...">{{ old('vision', $profile->vision ?? '') }}</textarea>
                @error('vision')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mission">Misi</label>
                <textarea class="form-control @error('mission') is-invalid @enderror" id="mission" name="mission" placeholder="Misi sekolah (pisahkan dengan enter untuk tiap poin)...">{{ old('mission', $profile->mission ?? '') }}</textarea>
                <p class="hint">Pisahkan setiap misi dengan enter/baris baru</p>
                @error('mission')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Kontak -->
        <div class="form-section">
            <h3>📞 Informasi Kontak</h3>

            <div class="form-group">
                <label for="address">Alamat Lengkap</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $profile->address ?? '') }}</textarea>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" placeholder="(0291) 123456">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $profile->email ?? '') }}" placeholder="sekolah@example.com">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Logo & Gambar -->
        <div class="form-section">
            <h3>🖼️ Logo & Gambar</h3>

            <div class="form-group">
                <label for="logo">Logo Sekolah</label>
                @if(isset($profile->logo) && $profile->logo)
                    <div>
                        <img src="{{ asset('storage/' . $profile->logo) }}" class="current-image" alt="Logo">
                        <p class="hint">Logo saat ini</p>
                    </div>
                @endif
                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*" onchange="previewLogo(this)" style="margin-top:0.5rem;">
                <img id="logoPreview" class="preview-image">
                @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Lokasi Sekolah -->
        <div class="form-section">
            <h3>📍 Lokasi Sekolah</h3>

            <div class="form-group">
                <label for="location_image">Gambar Denah / Peta Lokasi</label>
                @if(isset($profile->location_image) && $profile->location_image)
                    <div>
                        <img src="{{ asset('storage/' . $profile->location_image) }}" class="current-image" alt="Denah Lokasi" style="max-width:300px;">
                        <p class="hint">Gambar denah saat ini</p>
                    </div>
                @endif
                <input type="file" class="form-control @error('location_image') is-invalid @enderror" id="location_image" name="location_image" accept="image/*" onchange="previewLocation(this)" style="margin-top:0.5rem;">
                <img id="locationPreview" class="preview-image">
                <p class="hint">Upload gambar denah lokasi sekolah atau screenshot dari Google Maps (Max 2MB)</p>
                @error('location_image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="google_maps_url">Link Google Maps</label>
                <input type="url" class="form-control @error('google_maps_url') is-invalid @enderror" id="google_maps_url" name="google_maps_url" value="{{ old('google_maps_url', $profile->google_maps_url ?? '') }}" placeholder="https://maps.app.goo.gl/vc1EkcFMhXxpY6TU9">
                <p class="hint">Buka Google Maps → Cari lokasi sekolah → Klik "Bagikan" → Salin link</p>
                @error('google_maps_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-submit">💾 Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<script>
function previewLogo(input) {
    const preview = document.getElementById('logoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLocation(input) {
    const preview = document.getElementById('locationPreview');
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
