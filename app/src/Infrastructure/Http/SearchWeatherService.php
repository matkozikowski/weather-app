<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Client\OWClient;
use App\Domain\Model\Search;
use App\Infrastructure\Factory\TemperatureFactory;
use App\Infrastructure\Provider\ServicesProvider;
use App\Infrastructure\Client\ClientInterface;
use Doctrine\Common\Collections\ArrayCollection;

class SearchWeatherService
{
    /**
     * @var OWClient
     */
    private $servicesProvider;

    /**
     * @var TemperatureFactory
     */
    private $temperatureFactory;

    public function __construct(ServicesProvider $servicesProvider, TemperatureFactory $temperatureFactory)
    {
        $this->servicesProvider = $servicesProvider;
        $this->temperatureFactory = $temperatureFactory;
    }

    public function search(Search $search): string
    {
        $temperatures = $this->getTemperatures($search);

        if ($temperatures->count() === 1) {
            return (string)round($temperatures->first());
        }

        return (string) $temperatures;
    }

    private function getTemperatures(Search $search): ArrayCollection
    {
        $temperatures = new ArrayCollection();
        foreach ($this->servicesProvider->getServices() as $apiService) {
            if ($apiService instanceof ClientInterface) {
                $temperature = $apiService->getResponse($search->city(), $search->country());
                if (false === empty($temperature)) {
                    $temperatures->add($this->temperatureFactory->create($temperature));
                }
            }
        }

        return $temperatures;
    }
}