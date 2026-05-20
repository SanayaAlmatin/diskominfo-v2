<?php

namespace App\Http\Controllers;

use App\Http\Requests\WifiLocationBoundsRequest;
use App\Models\TmKoordinatWifi;
use App\Support\WifiCoordinateNormalizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WifiLocationController extends Controller
{
    private const MAX_POINTS = 1200;
    private const CACHE_TTL_SECONDS = 120;
    private const CACHE_NAMESPACE = 'v5';

    public function index(WifiLocationBoundsRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $zoom = isset($validated['zoom']) ? (int) $validated['zoom'] : null;

        [$south, $north, $west, $east] = $this->normalizeBounds($validated);
        $precision = $this->bucketPrecision($zoom);
        $cacheKey = $this->cacheKey(
            $south,
            $north,
            $west,
            $east,
            $zoom,
            $precision,
            $this->coordinatesVersion(),
        );

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
        int $version,
    ): string {
        return sprintf(
            'wifi-locations:%s:%s:%s:%s:%s:z%s:p%s:d%s',
            self::CACHE_NAMESPACE,
            number_format(round($south, $precision), $precision, '.', ''),
            number_format(round($north, $precision), $precision, '.', ''),
            number_format(round($west, $precision), $precision, '.', ''),
            number_format(round($east, $precision), $precision, '.', ''),
            $zoom ?? 'na',
            $precision,
            $version,
        );
    }

    private function queryLocationsPayload(float $south, float $north, float $west, float $east): array
    {
        $rows = [];

        foreach (TmKoordinatWifi::query()
            ->select(['id', 'n_wilayah', 'latitude', 'longitude', 'ssid', 'kecepatan', 'keterangan'])
            ->withCoordinates()
            ->orderByDesc('id')
            ->cursor() as $location) {
            $coordinates = $this->normalizeCoordinates($location->latitude, $location->longitude);
            if ($coordinates === null || !$this->isWithinBounds($coordinates, $south, $north, $west, $east)) {
                continue;
            }

            $rows[] = [
                'id' => $location->id,
                'n_wilayah' => $location->n_wilayah,
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
                'ssid' => $location->ssid,
                'kecepatan' => $location->kecepatan,
                'keterangan' => $location->keterangan,
            ];

            if (count($rows) > self::MAX_POINTS) {
                return [
                    'locations' => array_slice($rows, 0, self::MAX_POINTS),
                    'has_more' => true,
                ];
            }
        }

        return [
            'locations' => $rows,
            'has_more' => false,
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
        return WifiCoordinateNormalizer::normalize($latitude, $longitude);
    }

    private function isWithinBounds(array $coordinates, float $south, float $north, float $west, float $east): bool
    {
        return $coordinates['latitude'] >= $south
            && $coordinates['latitude'] <= $north
            && $coordinates['longitude'] >= $west
            && $coordinates['longitude'] <= $east;
    }

    private function coordinatesVersion(): int
    {
        $latestUpdate = TmKoordinatWifi::query()->max('updated_at');

        return $latestUpdate ? strtotime((string) $latestUpdate) ?: 0 : 0;
    }
}
