<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\CQRS\CommandInterface;
use App\CQRS\CommandHandleInterface;
use App\Domain\Model\Search;
use App\Domain\Model\Weather;
use App\Domain\Weathers;
use App\Infrastructure\Http\SearchWeatherService;

class SearchWeatherHandler implements CommandHandleInterface
{
    /**
     * @var SearchWeatherService
     */
    private $searchWeatherService;

    /**
     * @var Weathers
     */
    private $weathers;

    public function __construct(SearchWeatherService $searchWeatherService, Weathers $weathers)
    {
        $this->searchWeatherService = $searchWeatherService;
        $this->weathers = $weathers;
    }

    public function handle(CommandInterface $command): void
    {
        $search = new Search(
            $command->getCountry(),
            $command->getCity()
        );

        $temperature = $this->searchWeatherService->search($search);

        $weather = new Weather(
            $search,
            $temperature
        );

        $this->weathers->add($weather);
    }
}
