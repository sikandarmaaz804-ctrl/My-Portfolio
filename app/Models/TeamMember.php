<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'expertise',
        'experience_years',
        'description',
        'photo',
        'sort_order',
    ];

    protected $casts = [
        'experience_years' => 'integer',
        'sort_order'       => 'integer',
    ];
}
