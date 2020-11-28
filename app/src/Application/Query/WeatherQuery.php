<?php

declare(strict_types=1);

namespace App\Application\Query;

interface WeatherQuery
{
    public function findAll(): array;
}
