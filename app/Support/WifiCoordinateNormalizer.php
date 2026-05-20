<?php

namespace App\Support;

class WifiCoordinateNormalizer
{
    private const STORAGE_SCALE = 6;
    private const MAX_SHIFT_STEPS = 12;
    private const PREFERRED_LATITUDE_MIN = -7.5;
    private const PREFERRED_LATITUDE_MAX = -5.0;
    private const PREFERRED_LONGITUDE_MIN = 106.0;
    private const PREFERRED_LONGITUDE_MAX = 107.5;

    public static function normalize(mixed $latitude, mixed $longitude): ?array
    {
        $latitudeCandidates = self::coordinateCandidates($latitude, 90.0);
        $longitudeCandidates = self::coordinateCandidates($longitude, 180.0);

        if ($latitudeCandidates === [] || $longitudeCandidates === []) {
            return null;
        }

        return self::bestCoordinatePair($latitudeCandidates, $longitudeCandidates);
    }

    public static function normalizeForStorage(mixed $latitude, mixed $longitude): ?array
    {
        $coordinates = self::normalize($latitude, $longitude);

        if ($coordinates === null) {
            return null;
        }

        return [
            'latitude' => self::format($coordinates['latitude']),
            'longitude' => self::format($coordinates['longitude']),
        ];
    }

    private static function coordinateCandidates(mixed $value, float $maxAbsolute): array
    {
        if (!is_scalar($value)) {
            return [];
        }

        $normalized = preg_replace('/\s+/', '', trim((string) $value));
        $normalized = str_replace(',', '.', $normalized ?? '');

        if ($normalized === '' || !is_numeric($normalized)) {
            return [];
        }

        $coordinate = (float) $normalized;
        $candidates = [];
        $seen = [];

        for ($shift = 0; $shift <= self::MAX_SHIFT_STEPS; $shift++) {
            if (abs($coordinate) <= $maxAbsolute) {
                $key = sprintf('%.10f', $coordinate);

                if (!isset($seen[$key])) {
                    $candidates[] = [
                        'value' => round($coordinate, 10),
                        'shift' => $shift,
                    ];
                    $seen[$key] = true;
                }
            }

            if ($coordinate === 0.0) {
                break;
            }

            $coordinate /= 10;
        }

        return $candidates;
    }

    private static function bestCoordinatePair(array $latitudeCandidates, array $longitudeCandidates): ?array
    {
        $bestPair = null;
        $bestScore = null;

        foreach ([false, true] as $isSwapped) {
            $candidateLatitudes = $isSwapped ? $longitudeCandidates : $latitudeCandidates;
            $candidateLongitudes = $isSwapped ? $latitudeCandidates : $longitudeCandidates;

            foreach ($candidateLatitudes as $latitudeCandidate) {
                foreach ($candidateLongitudes as $longitudeCandidate) {
                    $latitude = $latitudeCandidate['value'];
                    $longitude = $longitudeCandidate['value'];

                    if (!self::isGloballyValid($latitude, $longitude)) {
                        continue;
                    }

                    $score = self::candidateScore(
                        $latitude,
                        $longitude,
                        $latitudeCandidate['shift'] + $longitudeCandidate['shift'],
                        $isSwapped,
                    );

                    if ($bestScore === null || $score > $bestScore) {
                        $bestScore = $score;
                        $bestPair = [
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                        ];
                    }
                }
            }
        }

        return $bestPair;
    }

    private static function candidateScore(float $latitude, float $longitude, int $shiftCount, bool $isSwapped): int
    {
        $score = self::isPreferredCoordinate($latitude, $longitude) ? 10_000 : 1_000;
        $score -= $shiftCount * 10;
        $score += $isSwapped ? 0 : 100;

        return $score;
    }

    private static function isGloballyValid(float $latitude, float $longitude): bool
    {
        return abs($latitude) <= 90 && abs($longitude) <= 180;
    }

    private static function isPreferredCoordinate(float $latitude, float $longitude): bool
    {
        return $latitude >= self::PREFERRED_LATITUDE_MIN
            && $latitude <= self::PREFERRED_LATITUDE_MAX
            && $longitude >= self::PREFERRED_LONGITUDE_MIN
            && $longitude <= self::PREFERRED_LONGITUDE_MAX;
    }

    private static function format(float $value): string
    {
        return number_format($value, self::STORAGE_SCALE, '.', '');
    }
}
