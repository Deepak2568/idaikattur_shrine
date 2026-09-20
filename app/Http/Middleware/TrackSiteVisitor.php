<?php

namespace App\Http\Middleware;

use App\Models\SiteVisitor;
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
            $hash = hash('sha256', $request->ip().'|'.$date);

            SiteVisitor::query()->firstOrCreate(
                [
                    'visit_date' => $date,
                    'visitor_hash' => $hash,
                ]
            );
        } catch (\Throwable $e) {
            // Never break the site if tracking fails.
            report($e);
        }

        return $response;
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
