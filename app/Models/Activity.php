<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'date',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date' => 'date'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}