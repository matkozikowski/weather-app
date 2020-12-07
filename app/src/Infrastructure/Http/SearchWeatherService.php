<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Client\OWClient;
use App\Domain\Model\Search;
use App\Infrastructure\Provider\ServicesProvider;
use App\Infrastructure\Client\ClientInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Infrastructure\Factory\CompareTemperatureFactory;

class SearchWeatherService
{
    /**
     * @var OWClient
     */
    private $servicesProvider;

    /**
     * @var CompareTemperatureFactory
     */
    private $compareTemperatureFactory;

    public function __construct(ServicesProvider $servicesProvider, CompareTemperatureFactory $compareTemperatureFactory)
    {
        $this->servicesProvider = $servicesProvider;
        $this->compareTemperatureFactory = $compareTemperatureFactory;
    }

    public function search(Search $search): string
    {
        $temperatures = $this->getTemperatures($search);

        if ($temperatures->count() === 1) {
            return (string)round($temperatures->first());
        }

        return $this->compareTemperatureFactory->create($temperatures);
    }

    private function getTemperatures(Search $search): ArrayCollection
    {
        $temperatures = new ArrayCollection();
        foreach ($this->servicesProvider->getServices() as $apiService) {
            if ($apiService instanceof ClientInterface) {
                $temperature = $apiService->getResponse($search->city(), $search->country());
                if (false === empty($temperature)) {
                    $temperatures->add($temperature);
                }
            }
        }

        return $temperatures;
    }
}