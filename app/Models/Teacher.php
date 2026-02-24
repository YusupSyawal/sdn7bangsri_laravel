<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'specialty',
        'experience',
        'photo',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}