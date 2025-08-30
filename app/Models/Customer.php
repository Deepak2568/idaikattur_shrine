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
        'profile_image',
        'termsAccepted',
        'active_status',
        'is_admin',
        'address',
        'height',
        'weight',
        'body_type',
        'complexion',
        'blood_group',
        'physical_status',
        'marital_status',
        'education',
        'education_details',
        'employed_in',
        'occupation_details',
        'occupation_category',
        'working_state',
        'working_place',
        'salary',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'brother_name',
        'brother_occupation',
        'brother_status',
        'sister_name',
        'sister_occupation',
        'sister_status',
        'partner_preference',
        'last_dashboard_visit',
    ];

    // Automatically hash when setting password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Check if dashboard visit should be updated for today
     * Returns true if it's a new day or if last_dashboard_visit is null
     */
    public function shouldUpdateDashboardVisit(): bool
    {
        if (!$this->last_dashboard_visit) {
            return true;
        }

        $today = now()->startOfDay();
        $lastVisit = \Carbon\Carbon::parse($this->last_dashboard_visit)->startOfDay();
        
        return $lastVisit->lt($today);
    }

    /**
     * Update the dashboard visit timestamp
     */
    public function updateDashboardVisit(): void
    {
        $this->update([
            'last_dashboard_visit' => now(),
            'updated_at' => now()
        ]);
    }
}
