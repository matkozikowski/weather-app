<?php

declare(strict_types=1);

namespace App\Infrastructure\Provider;

use App\Infrastructure\Client\ClientInterface;

interface ServicesProviderInterface
{
    public function addService(ClientInterface $client);
}