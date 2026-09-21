<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'amount',
        'message',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public static function countPending(): int
    {
        return static::query()->where('status', 'pending')->count();
    }
}
