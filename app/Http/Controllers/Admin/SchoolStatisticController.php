<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolStatistic;
use Illuminate\Http\Request;

class SchoolStatisticController extends Controller
{
    /**
     * Tampilkan form edit statistik sekolah
     */
    public function edit()
    {
        $statistic = SchoolStatistic::first();
        
        // Jika belum ada data, buat baru
        if (!$statistic) {
            $statistic = SchoolStatistic::create([
                'tahun_ajaran' => '2026/2027',
                'peserta_didik' => 0,
                'guru' => 0,
                'rombel' => 0,
            ]);
        }
        
        return view('admin.statistics.edit', compact('statistic'));
    }

    /**
     * Update data statistik sekolah
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'peserta_didik' => 'required|integer|min:0|max:9999',
            'guru' => 'required|integer|min:0|max:999',
            'rombel' => 'required|integer|min:0|max:99',
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'peserta_didik.required' => 'Jumlah peserta didik wajib diisi.',
            'peserta_didik.integer' => 'Jumlah peserta didik harus berupa angka.',
            'peserta_didik.min' => 'Jumlah peserta didik minimal 0.',
            'guru.required' => 'Jumlah guru wajib diisi.',
            'guru.integer' => 'Jumlah guru harus berupa angka.',
            'guru.min' => 'Jumlah guru minimal 0.',
            'rombel.required' => 'Jumlah rombel wajib diisi.',
            'rombel.integer' => 'Jumlah rombel harus berupa angka.',
            'rombel.min' => 'Jumlah rombel minimal 0.',
        ]);

        $statistic = SchoolStatistic::first();
        
        if (!$statistic) {
            SchoolStatistic::create($validated);
        } else {
            $statistic->update($validated);
        }

        return redirect()->route('admin.statistics.edit')
            ->with('success', 'Data statistik sekolah berhasil diupdate!');
    }
}
