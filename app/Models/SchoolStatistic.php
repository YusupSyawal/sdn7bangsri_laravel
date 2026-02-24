<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolStatistic extends Model
{
    protected $table = 'school_statistics';

    protected $fillable = [
        'tahun_ajaran',
        'peserta_didik',
        'guru',
        'rombel',
    ];

    /**
     * Get statistik sekolah (singleton pattern)
     * Jika belum ada data, return default values
     */
    public static function getData(): self
    {
        $stat = self::first();
        
        if (!$stat) {
            $stat = new self([
                'tahun_ajaran' => '2026/2027',
                'peserta_didik' => 0,
                'guru' => 0,
                'rombel' => 0,
            ]);
        }
        
        return $stat;
    }

    /**
     * Format angka dengan separator ribuan
     */
    public function getFormattedPesertaDidikAttribute(): string
    {
        return number_format($this->peserta_didik, 0, ',', '.');
    }

    public function getFormattedGuruAttribute(): string
    {
        return number_format($this->guru, 0, ',', '.');
    }

    public function getFormattedRombelAttribute(): string
    {
        return number_format($this->rombel, 0, ',', '.');
    }
}
