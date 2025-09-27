<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priest extends Model
{
    use HasFactory;

    protected $fillable = [
        'father_name',
        'designation',
        'from_year',
        'to_year',
        'image_path',
        'original_name',
        'image_type',
        'file_size'
    ];

    protected $casts = [
        'from_year' => 'integer',
        'to_year' => 'integer',
    ];

    /**
     * Get priests ordered by from_year (most recent first)
     */
    public static function getRecentPriests()
    {
        return self::orderBy('from_year', 'desc')
                   ->orderBy('to_year', 'desc')
                   ->get();
    }

    /**
     * Get current priest (no to_year or to_year is null)
     */
    public static function getCurrentPriest()
    {
        return self::whereNull('to_year')
                   ->orderBy('from_year', 'desc')
                   ->first();
    }

    /**
     * Get priests by year range
     */
    public static function getPriestsByYearRange($fromYear, $toYear = null)
    {
        $query = self::query();
        
        if ($toYear) {
            $query->where(function($q) use ($fromYear, $toYear) {
                $q->whereBetween('from_year', [$fromYear, $toYear])
                  ->orWhereBetween('to_year', [$fromYear, $toYear])
                  ->orWhere(function($subQ) use ($fromYear, $toYear) {
                      $subQ->where('from_year', '<=', $fromYear)
                           ->where(function($subSubQ) use ($toYear) {
                               $subSubQ->whereNull('to_year')
                                      ->orWhere('to_year', '>=', $toYear);
                           });
                  });
            });
        } else {
            $query->where('from_year', '<=', $fromYear)
                  ->where(function($q) use ($fromYear) {
                      $q->whereNull('to_year')
                        ->orWhere('to_year', '>=', $fromYear);
                  });
        }
        
        return $query->orderBy('from_year', 'desc')->get();
    }

    /**
     * Get the year range display string
     */
    public function getYearRangeAttribute()
    {
        if ($this->to_year) {
            return $this->from_year . ' - ' . $this->to_year;
        }
        return $this->from_year . ' - ';
    }

    /**
     * Check if priest is current
     */
    public function isCurrent()
    {
        return is_null($this->to_year);
    }
}
