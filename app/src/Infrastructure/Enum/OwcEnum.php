<?php

declare(strict_types=1);

namespace App\Infrastructure\Enum;

class OwcEnum
{
    public const WEATHER_ENDPOINT = 'https://api.openweathermap.org/data/2.5/weather';
    public const RESPONSE_MAIN_INDEX = 'main';
    public const RESPONSE_TEMP_INDEX = 'temp';
}