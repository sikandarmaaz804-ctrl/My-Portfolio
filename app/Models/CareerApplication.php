<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'education',
        'expertise',
        'experience',
        'introduction',
        'status',
    ];

    /**
     * Human-readable status labels.
     */
    public static function statusLabels(): array
    {
        return [
            'new'         => 'New',
            'reviewed'    => 'Reviewed',
            'shortlisted' => 'Shortlisted',
            'rejected'    => 'Rejected',
        ];
    }

    /**
     * Bootstrap badge colour per status.
     */
    public static function statusColors(): array
    {
        return [
            'new'         => 'warning',
            'reviewed'    => 'info',
            'shortlisted' => 'success',
            'rejected'    => 'danger',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return static::statusLabels()[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return static::statusColors()[$this->status] ?? 'secondary';
    }
}
