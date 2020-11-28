<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;


class TemperatureFactory
{
    private const KELVIN_STATIC_VAL = 273.15;

    public function create(float $value): float
    {
        return $value - self::KELVIN_STATIC_VAL;
    }
}
