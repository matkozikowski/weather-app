<?php

declare(strict_types=1);

namespace App\Infrastructure\Enum;

class WeatherStackEnum
{
    public const WEATHER_ENDPOINT = 'http://api.weatherstack.com/current';
    public const RESPONSE_MAIN_INDEX = 'current';
    public const RESPONSE_TEMP_INDEX = 'temperature';
}