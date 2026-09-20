<?php

namespace App\Http\Middleware;

use App\Models\SiteVisitor;
use App\Services\IpGeolocation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldSkip($request)) {
            return $response;
        }

        try {
            $date = now()->toDateString();
            $ip = $request->ip();
            $hash = hash('sha256', $ip.'|'.$date);

            $visitor = SiteVisitor::query()->firstOrCreate(
                [
                    'visit_date' => $date,
                    'visitor_hash' => $hash,
                ]
            );

            // Fill location for new rows, or older rows that still have null place data.
            if ($this->needsLocation($visitor)) {
                $location = app(IpGeolocation::class)->lookup($ip);

                if ($location['country'] || $location['region'] || $location['city']) {
                    $visitor->fill($location)->save();
                }
            }
        } catch (\Throwable $e) {
            // Never break the site if tracking fails.
            report($e);
        }

        return $response;
    }

    private function needsLocation(SiteVisitor $visitor): bool
    {
        return blank($visitor->country)
            && blank($visitor->region)
            && blank($visitor->city);
    }

    private function shouldSkip(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return true;
        }

        if ($request->ajax() || $request->expectsJson()) {
            return true;
        }

        $path = trim($request->path(), '/');

        $skipPrefixes = [
            'ci-deploy',
            'up',
            'css/',
            'storage/',
            'livewire',
        ];

        foreach ($skipPrefixes as $prefix) {
            if ($path === rtrim($prefix, '/') || str_starts_with($path, $prefix)) {
                return true;
            }
        }

        return false;
    }
}
