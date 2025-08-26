<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    //
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
