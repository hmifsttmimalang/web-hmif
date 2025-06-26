<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $fillable = ['start_at', 'end_at', 'is_active'];

    public static function isOpen(): bool
    {
        return self::where('is_active', true)
            ->where('start_at', '<=', now())
            ->where('end_at', '>=', now())
            ->exists();
    }
}
