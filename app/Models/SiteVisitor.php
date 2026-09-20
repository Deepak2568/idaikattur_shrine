<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteVisitor extends Model
{
    protected $fillable = [
        'visit_date',
        'visitor_hash',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public static function countForDate(string $date): int
    {
        return static::query()->whereDate('visit_date', $date)->count();
    }

    public static function countToday(): int
    {
        return static::countForDate(now()->toDateString());
    }

    public static function recentDays(int $days = 7): array
    {
        $from = now()->subDays($days - 1)->toDateString();

        $rows = static::query()
            ->select('visit_date', DB::raw('COUNT(*) as total'))
            ->whereDate('visit_date', '>=', $from)
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->get()
            ->keyBy(fn ($row) => $row->visit_date->toDateString());

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $result[] = [
                'date' => $date,
                'total' => (int) ($rows[$date]->total ?? 0),
            ];
        }

        return $result;
    }
}
