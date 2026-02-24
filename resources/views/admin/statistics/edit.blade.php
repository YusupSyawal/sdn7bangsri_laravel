@extends('admin.layout.app')

@section('title', 'Edit Statistik Sekolah')
@section('page-title', 'Statistik Sekolah')
@section('page-subtitle', 'Kelola data statistik yang ditampilkan di homepage')

@section('styles')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 700px;
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .form-header h2 {
        font-size: 1.3rem;
        color: #1a202c;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-header p {
        color: #718096;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .stats-preview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-radius: 12px;
        border: 1px solid #bbf7d0;
    }

    .preview-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .preview-item .icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .preview-item .value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #059669;
    }

    .preview-item .label {
        font-size: 0.8rem;
        color: #6b7280;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2d3748;
    }

    .form-group label .icon {
        font-size: 1.2rem;
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

    .form-hint {
        font-size: 0.8rem;
        color: #718096;
        margin-top: 0.25rem;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        background: #cbd5e0;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Alert */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .alert-icon {
        font-size: 1.3rem;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <div class="form-header">
        <h2>📊 Edit Statistik Sekolah</h2>
        <p>Data ini akan ditampilkan pada halaman utama website</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <span class="alert-icon">✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Preview Statistik -->
    <div class="stats-preview">
        <div class="preview-item">
            <div class="icon">📅</div>
            <div class="value" id="previewTahun">{{ $statistic->tahun_ajaran }}</div>
            <div class="label">Tahun Ajaran</div>
        </div>
        <div class="preview-item">
            <div class="icon">👨‍🎓</div>
            <div class="value" id="previewSiswa">{{ $statistic->peserta_didik }}</div>
            <div class="label">Peserta Didik</div>
        </div>
        <div class="preview-item">
            <div class="icon">👨‍🏫</div>
            <div class="value" id="previewGuru">{{ $statistic->guru }}</div>
            <div class="label">Guru</div>
        </div>
        <div class="preview-item">
            <div class="icon">🏫</div>
            <div class="value" id="previewRombel">{{ $statistic->rombel }}</div>
            <div class="label">Rombel</div>
        </div>
    </div>

    <form action="{{ route('admin.statistics.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <!-- Tahun Ajaran -->
            <div class="form-group full-width">
                <label>
                    <span class="icon">📅</span> Tahun Ajaran
                </label>
                <input type="text" 
                       name="tahun_ajaran" 
                       id="tahun_ajaran"
                       class="form-control" 
                       value="{{ old('tahun_ajaran', $statistic->tahun_ajaran) }}"
                       placeholder="Contoh: 2026/2027"
                       required>
                <p class="form-hint">Format: YYYY/YYYY (contoh: 2026/2027)</p>
                @error('tahun_ajaran')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Peserta Didik -->
            <div class="form-group">
                <label>
                    <span class="icon">👨‍🎓</span> Jumlah Peserta Didik
                </label>
                <input type="number" 
                       name="peserta_didik" 
                       id="peserta_didik"
                       class="form-control" 
                       value="{{ old('peserta_didik', $statistic->peserta_didik) }}"
                       placeholder="0"
                       min="0"
                       max="9999"
                       required>
                @error('peserta_didik')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Guru -->
            <div class="form-group">
                <label>
                    <span class="icon">👨‍🏫</span> Jumlah Guru
                </label>
                <input type="number" 
                       name="guru" 
                       id="guru"
                       class="form-control" 
                       value="{{ old('guru', $statistic->guru) }}"
                       placeholder="0"
                       min="0"
                       max="999"
                       required>
                @error('guru')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Rombel -->
            <div class="form-group">
                <label>
                    <span class="icon">🏫</span> Jumlah Rombel (Kelas)
                </label>
                <input type="number" 
                       name="rombel" 
                       id="rombel"
                       class="form-control" 
                       value="{{ old('rombel', $statistic->rombel) }}"
                       placeholder="0"
                       min="0"
                       max="99"
                       required>
                <p class="form-hint">Rombongan Belajar / Jumlah Kelas</p>
                @error('rombel')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-submit">
                💾 Simpan Perubahan
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Live preview saat mengetik
    document.getElementById('tahun_ajaran').addEventListener('input', function() {
        document.getElementById('previewTahun').textContent = this.value || '-';
    });

    document.getElementById('peserta_didik').addEventListener('input', function() {
        document.getElementById('previewSiswa').textContent = this.value || '0';
    });

    document.getElementById('guru').addEventListener('input', function() {
        document.getElementById('previewGuru').textContent = this.value || '0';
    });

    document.getElementById('rombel').addEventListener('input', function() {
        document.getElementById('previewRombel').textContent = this.value || '0';
    });
</script>
@endsection
