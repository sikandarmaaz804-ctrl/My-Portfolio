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

        $path = ltrim($this->image, '/');

        // Already a full uploads/ path (shouldn't happen with new code, just safety)
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        // Legacy records saved with "blogs/filename" prefix — strip it, file is in uploads/
        if (str_starts_with($path, 'blogs/')) {
            $path = substr($path, strlen('blogs/'));
        }

        // All files live directly in uploads/
        return asset('uploads/' . $path);
    }
}
