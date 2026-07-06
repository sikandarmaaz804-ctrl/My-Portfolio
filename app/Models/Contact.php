<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    /**
     * Automatically purge messages that have been in trash for more than 5 days.
     */
    public static function purgeOldTrashed(): void
    {
        self::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(5))
            ->forceDelete();
    }
}
