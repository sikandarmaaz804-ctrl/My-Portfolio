<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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
            return 'https://via.placeholder.com/600x210/766dff/fff?text=Blog';
        }

        $path = ltrim($this->image, '/');

        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        if (File::exists(public_path('uploads/' . $path))) {
            return asset('uploads/' . $path);
        }

        return asset($path);
    }
}
