<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'client_name',
        'category',
        'website_link',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6'
    ];
}
