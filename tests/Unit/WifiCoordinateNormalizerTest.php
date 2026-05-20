<?php

namespace Tests\Unit;

use App\Support\WifiCoordinateNormalizer;
use PHPUnit\Framework\TestCase;

class WifiCoordinateNormalizerTest extends TestCase
{
    public function test_it_normalizes_legacy_coordinates_without_decimal_points(): void
    {
        $coordinates = WifiCoordinateNormalizer::normalize('-6224840', '106688320');

        $this->assertSame(-6.22484, $coordinates['latitude']);
        $this->assertSame(106.68832, $coordinates['longitude']);
    }

    public function test_it_swaps_legacy_coordinates_when_the_columns_are_reversed(): void
    {
        $coordinates = WifiCoordinateNormalizer::normalize('106717900', '-6288600');

        $this->assertSame(-6.2886, $coordinates['latitude']);
        $this->assertSame(106.7179, $coordinates['longitude']);
    }

    public function test_it_fixes_legacy_coordinates_when_the_decimal_point_is_shifted(): void
    {
        $coordinates = WifiCoordinateNormalizer::normalize('-63.277340', '106.682478');

        $this->assertSame(-6.327734, $coordinates['latitude']);
        $this->assertSame(106.682478, $coordinates['longitude']);
    }
}
