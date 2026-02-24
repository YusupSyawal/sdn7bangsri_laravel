<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Boot method untuk auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Scope untuk berita aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk berita yang sudah dipublikasikan
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
                     ->whereNotNull('published_at');
    }

    /**
     * Scope untuk berita terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Accessor untuk mendapatkan URL gambar
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Accessor untuk mendapatkan excerpt dari content
     */
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Format tanggal publikasi
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->translatedFormat('d F Y') : '-';
    }
}
