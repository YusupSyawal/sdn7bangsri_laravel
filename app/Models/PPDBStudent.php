<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPDBStudent extends Model
{
    protected $table = 'ppdb_students';

    protected $fillable = [
        'student_name',
        'parent_name',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'email',
        'kk_file',
        'akta_file',
        'photo_file',
        'status',
        'notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get status label dengan badge class
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            default => 'Unknown'
        };
    }

    /**
     * Get gender label
     */
    public function getGenderLabelAttribute(): string
    {
        return match($this->gender) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => '-'
        };
    }
}
