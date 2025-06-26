<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $fillable = ['start_at', 'end_at', 'is_active'];

    public static function isOpen(): bool
    {
        $period = self::where('is_active', true)
            ->orderByDesc('start_at')
            ->first();

        return $period
            ? now()->between($period->start_at, $period->end_at)
            : false;
    }

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
