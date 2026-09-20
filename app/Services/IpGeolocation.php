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

        $result = $this->lookupIpWhoIs($ip)
            ?? $this->lookupIpApi($ip);

        return $result ?? $empty;
    }

    /**
     * @return array{country: ?string, region: ?string, city: ?string}|null
     */
    private function lookupIpWhoIs(string $ip): ?array
    {
        try {
            $response = Http::timeout(4)
                ->acceptJson()
                ->withHeaders(['User-Agent' => 'IdaikatturShrine/1.0'])
                ->get("https://ipwho.is/{$ip}");

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            if (! is_array($data) || ! ($data['success'] ?? false)) {
                return null;
            }

            return [
                'country' => $this->clean($data['country'] ?? null),
                'region' => $this->clean($data['region'] ?? null),
                'city' => $this->clean($data['city'] ?? null),
            ];
        } catch (\Throwable $e) {
            Log::warning('IP geolocation (ipwho.is) failed', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Free fallback (HTTP). Used when HTTPS provider fails on host.
     *
     * @return array{country: ?string, region: ?string, city: ?string}|null
     */
    private function lookupIpApi(string $ip): ?array
    {
        try {
            $response = Http::timeout(4)
                ->acceptJson()
                ->withHeaders(['User-Agent' => 'IdaikatturShrine/1.0'])
                ->get("http://ip-api.com/json/{$ip}", [
                    'fields' => 'status,country,regionName,city',
                ]);

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            if (! is_array($data) || ($data['status'] ?? null) !== 'success') {
                return null;
            }

            return [
                'country' => $this->clean($data['country'] ?? null),
                'region' => $this->clean($data['regionName'] ?? null),
                'city' => $this->clean($data['city'] ?? null),
            ];
        } catch (\Throwable $e) {
            Log::warning('IP geolocation (ip-api) failed', [
                'message' => $e->getMessage(),
            ]);

            return null;
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
