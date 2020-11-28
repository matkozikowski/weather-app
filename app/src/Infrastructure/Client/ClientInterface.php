<?php

declare(strict_types=1);

namespace App\Infrastructure\Client;

interface ClientInterface
{
    public function getResponse(string $city, string $country): ?float;
}
