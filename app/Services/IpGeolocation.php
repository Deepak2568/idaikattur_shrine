<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IpGeolocation
{
    /**
     * Resolve approximate location from an IP address.
     * Returns country / region / city only — never stores the raw IP.
     *
     * @return array{country: ?string, region: ?string, city: ?string}
     */
    public function lookup(?string $ip): array
    {
        $empty = ['country' => null, 'region' => null, 'city' => null];

        if (! $ip || ! filter_var($ip, FILTER_VALIDATE_IP)) {
            return $empty;
        }

        // Local / private / reserved IPs cannot be geolocated.
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return [
                'country' => null,
                'region' => null,
                'city' => 'Local',
            ];
        }

        try {
            $response = Http::timeout(3)
                ->acceptJson()
                ->get("https://ipwho.is/{$ip}", [
                    'fields' => 'success,country,region,city',
                ]);

            if (! $response->successful()) {
                return $empty;
            }

            $data = $response->json();

            if (! ($data['success'] ?? false)) {
                return $empty;
            }

            return [
                'country' => $this->clean($data['country'] ?? null),
                'region' => $this->clean($data['region'] ?? null),
                'city' => $this->clean($data['city'] ?? null),
            ];
        } catch (\Throwable $e) {
            Log::warning('IP geolocation failed', [
                'message' => $e->getMessage(),
            ]);

            return $empty;
        }
    }

    private function clean(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? mb_substr($value, 0, 100) : null;
    }
}
