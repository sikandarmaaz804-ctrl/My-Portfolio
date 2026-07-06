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
}