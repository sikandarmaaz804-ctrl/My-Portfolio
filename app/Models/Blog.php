<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('img/placeholder-blog.svg');
        }

        // DB stores either "blogs/filename.ext" or legacy "filename.ext"
        // Always serve from uploads/ — works both locally and on Hostinger
        $path = ltrim($this->image, '/');

        // Already prefixed correctly
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        // Normalize: prepend uploads/
        return asset('uploads/' . $path);
    }
}
