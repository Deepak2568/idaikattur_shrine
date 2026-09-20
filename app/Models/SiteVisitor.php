<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteVisitor extends Model
{
    protected $fillable = [
        'visit_date',
        'visitor_hash',
        'country',
        'region',
        'city',
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

    /**
     * Top visitor locations for a date range (inclusive).
     *
     * @return list<array{label: string, country: ?string, region: ?string, city: ?string, total: int}>
     */
    public static function topLocations(int $days = 7, int $limit = 10): array
    {
        $from = now()->subDays($days - 1)->toDateString();

        $rows = static::query()
            ->select(
                'country',
                'region',
                'city',
                DB::raw('COUNT(*) as total')
            )
            ->whereDate('visit_date', '>=', $from)
            ->groupBy('country', 'region', 'city')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();

        return $rows->map(function ($row) {
            $parts = array_filter([$row->city, $row->region, $row->country]);
            $label = $parts ? implode(', ', $parts) : 'Unknown';

            return [
                'label' => $label,
                'country' => $row->country,
                'region' => $row->region,
                'city' => $row->city,
                'total' => (int) $row->total,
            ];
        })->all();
    }

    public function locationLabel(): string
    {
        $parts = array_filter([$this->city, $this->region, $this->country]);

        return $parts ? implode(', ', $parts) : 'Unknown';
    }
}
