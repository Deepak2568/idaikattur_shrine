<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Customer extends Authenticatable
{
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'dob',
        'gender',
        'religion',
        'subcaste',
        'state',
        'city',
        'password',
        'termsAccepted',
        'active_status',
        'is_admin',
    ];

    // Automatically hash when setting password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
