<?php

declare(strict_types=1);

namespace App\Infrastructure\Provider;

use App\Infrastructure\Client\ClientInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class ServicesProvider implements ServicesProviderInterface
{
    /**
     * @var Collection
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    public function addService(ClientInterface $client): void
    {
        $this->services->add($client);
    }

    public function getServices(): Collection
    {
        return $this->services;
    }
}
