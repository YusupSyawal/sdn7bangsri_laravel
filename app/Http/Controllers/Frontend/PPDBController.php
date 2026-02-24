<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PPDBStudent;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PPDBController extends Controller
{
    /**
     * Tampilkan halaman PPDB
     */
    public function index()
    {
        $profile = SchoolProfile::first();
        
        // Statistik PPDB (opsional)
        $totalPendaftar = PPDBStudent::count();
        $kuotaTersisa = 60 - $totalPendaftar; // Kuota dummy 60 siswa
        
        return view('frontend.ppdb', compact('profile', 'totalPendaftar', 'kuotaTersisa'));
    }

    /**
     * Proses pendaftaran PPDB
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:ppdb_students,nik',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:L,P',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'kk_file' => [
                'required',
                File::types(['pdf', 'jpg', 'jpeg', 'png'])
                    ->max(2 * 1024), // Max 2MB
            ],
            'akta_file' => [
                'required',
                File::types(['pdf', 'jpg', 'jpeg', 'png'])
                    ->max(2 * 1024), // Max 2MB
            ],
            'photo_file' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(1 * 1024), // Max 1MB
            ],
        ], [
            'student_name.required' => 'Nama siswa wajib diisi.',
            'parent_name.required' => 'Nama orang tua wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem.',
            'date_of_birth.before' => 'Tanggal lahir harus sebelum hari ini.',
            'kk_file.required' => 'File Kartu Keluarga wajib diupload.',
            'kk_file.max' => 'Ukuran file KK maksimal 2MB.',
            'akta_file.required' => 'File Akta Kelahiran wajib diupload.',
            'akta_file.max' => 'Ukuran file Akta maksimal 2MB.',
            'photo_file.max' => 'Ukuran foto maksimal 1MB.',
        ]);

        // Upload files
        $kkPath = null;
        $aktaPath = null;
        $photoPath = null;

        if ($request->hasFile('kk_file')) {
            $kkPath = $request->file('kk_file')->store('ppdb/kk', 'public');
        }

        if ($request->hasFile('akta_file')) {
            $aktaPath = $request->file('akta_file')->store('ppdb/akta', 'public');
        }

        if ($request->hasFile('photo_file')) {
            $photoPath = $request->file('photo_file')->store('ppdb/photo', 'public');
        }

        // Simpan data ke database
        PPDBStudent::create([
            'student_name' => $validated['student_name'],
            'parent_name' => $validated['parent_name'],
            'nik' => $validated['nik'],
            'place_of_birth' => $validated['place_of_birth'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'kk_file' => $kkPath,
            'akta_file' => $aktaPath,
            'photo_file' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('ppdb')
            ->with('success', 'Selamat! Pendaftaran PPDB berhasil dikirim. Silakan tunggu verifikasi dari panitia. Informasi lebih lanjut akan disampaikan melalui WhatsApp atau email.');
    }

    /**
     * Download formulir pendaftaran (dummy)
     */
    public function downloadFormulir()
    {
        // Path ke file formulir (buat file dummy atau actual)
        $filePath = public_path('documents/formulir-ppdb.pdf');
        
        if (file_exists($filePath)) {
            return response()->download($filePath, 'Formulir-PPDB-SDN7-Bangsri-2026.pdf');
        }

        return redirect()->route('ppdb')
            ->with('error', 'Formulir belum tersedia. Silakan hubungi panitia PPDB.');
    }
}
