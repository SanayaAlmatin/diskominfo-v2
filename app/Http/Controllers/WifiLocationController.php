<?php

namespace App\Http\Controllers;

use App\Http\Requests\WifiLocationBoundsRequest;
use App\Models\TmKoordinatWifi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WifiLocationController extends Controller
{
    private const MAX_POINTS = 1200;
    private const CACHE_TTL_SECONDS = 120;

    public function index(WifiLocationBoundsRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $zoom = isset($validated['zoom']) ? (int) $validated['zoom'] : null;

        [$south, $north, $west, $east] = $this->normalizeBounds($validated);
        $precision = $this->bucketPrecision($zoom);
        $cacheKey = $this->cacheKey($south, $north, $west, $east, $zoom, $precision);

        $cacheStore = Cache::store('file');
        $payload = $cacheStore->get($cacheKey);

        if (!$this->isValidPayload($payload)) {
            $cacheStore->forget($cacheKey);

            $payload = $this->queryLocationsPayload($south, $north, $west, $east);
            $cacheStore->put($cacheKey, $payload, now()->addSeconds(self::CACHE_TTL_SECONDS));
        }

        return response()
            ->json([
                'data' => $payload['locations'],
                'meta' => [
                    'has_more' => $payload['has_more'],
                    'limit' => self::MAX_POINTS,
                    'zoom' => $zoom,
                    'bounds' => [
                        'north' => $north,
                        'south' => $south,
                        'east' => $east,
                        'west' => $west,
                    ],
                ],
            ])
            ->header('Cache-Control', 'public, max-age=' . self::CACHE_TTL_SECONDS);
    }

    private function normalizeBounds(array $validated): array
    {
        $northInput = (float) $validated['north'];
        $southInput = (float) $validated['south'];
        $eastInput = (float) $validated['east'];
        $westInput = (float) $validated['west'];

        $north = max($northInput, $southInput);
        $south = min($northInput, $southInput);
        $east = max($eastInput, $westInput);
        $west = min($eastInput, $westInput);

        return [$south, $north, $west, $east];
    }

    private function bucketPrecision(?int $zoom): int
    {
        return match (true) {
            $zoom === null => 3,
            $zoom >= 16 => 5,
            $zoom >= 13 => 4,
            default => 3,
        };
    }

    private function cacheKey(
        float $south,
        float $north,
        float $west,
        float $east,
        ?int $zoom,
        int $precision,
    ): string {
        return sprintf(
            'wifi-locations:v4:%s:%s:%s:%s:z%s:p%s',
            number_format(round($south, $precision), $precision, '.', ''),
            number_format(round($north, $precision), $precision, '.', ''),
            number_format(round($west, $precision), $precision, '.', ''),
            number_format(round($east, $precision), $precision, '.', ''),
            $zoom ?? 'na',
            $precision,
        );
    }

    private function queryLocationsPayload(float $south, float $north, float $west, float $east): array
    {
        $locations = TmKoordinatWifi::query()
            ->select(['id', 'n_wilayah', 'latitude', 'longitude', 'ssid', 'kecepatan', 'keterangan'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', '')
            ->where(function ($query) use ($south, $north, $west, $east) {
                // Some migrated records are stored as "lat,lng" decimal-comma strings
                // and some are accidentally swapped between latitude/longitude columns.
                $query
                    ->whereRaw('CAST(REPLACE(TRIM(latitude), ",", ".") AS DECIMAL(10,7)) BETWEEN ? AND ?', [$south, $north])
                    ->whereRaw('CAST(REPLACE(TRIM(longitude), ",", ".") AS DECIMAL(10,7)) BETWEEN ? AND ?', [$west, $east])
                    ->orWhere(function ($swapped) use ($south, $north, $west, $east) {
                        $swapped
                            ->whereRaw('CAST(REPLACE(TRIM(longitude), ",", ".") AS DECIMAL(10,7)) BETWEEN ? AND ?', [$south, $north])
                            ->whereRaw('CAST(REPLACE(TRIM(latitude), ",", ".") AS DECIMAL(10,7)) BETWEEN ? AND ?', [$west, $east]);
                    });
            })
            ->orderByDesc('id')
            ->limit(self::MAX_POINTS + 1)
            ->get();

        $hasMore = $locations->count() > self::MAX_POINTS;
        if ($hasMore) {
            $locations = $locations->take(self::MAX_POINTS)->values();
        }

        $rows = $locations
            ->map(function (TmKoordinatWifi $location): ?array {
                $coordinates = $this->normalizeCoordinates($location->latitude, $location->longitude);
                if ($coordinates === null) {
                    return null;
                }

                return [
                    'id' => $location->id,
                    'n_wilayah' => $location->n_wilayah,
                    'latitude' => $coordinates['latitude'],
                    'longitude' => $coordinates['longitude'],
                    'ssid' => $location->ssid,
                    'kecepatan' => $location->kecepatan,
                    'keterangan' => $location->keterangan,
                ];
            })
            ->filter()
            ->values()
            ->all();

        return [
            'locations' => $rows,
            'has_more' => $hasMore,
        ];
    }

    private function isValidPayload(mixed $payload): bool
    {
        if (!is_array($payload)) {
            return false;
        }

        if (!array_key_exists('locations', $payload) || !array_key_exists('has_more', $payload)) {
            return false;
        }

        return is_array($payload['locations']) && is_bool($payload['has_more']);
    }

    private function normalizeCoordinates(mixed $latitude, mixed $longitude): ?array
    {
        $lat = $this->toCoordinateFloat($latitude);
        $lng = $this->toCoordinateFloat($longitude);

        if ($lat === null || $lng === null) {
            return null;
        }

        if (abs($lat) > 90 && abs($lng) <= 90) {
            [$lat, $lng] = [$lng, $lat];
        }

        if (abs($lat) > 90 || abs($lng) > 180) {
            return null;
        }

        return [
            'latitude' => $lat,
            'longitude' => $lng,
        ];
    }

    private function toCoordinateFloat(mixed $value): ?float
    {
        if (!is_scalar($value)) {
            return null;
        }

        $normalized = str_replace(',', '.', trim((string) $value));
        if ($normalized === '' || !is_numeric($normalized)) {
            return null;
        }

        return (float) $normalized;
    }
}
