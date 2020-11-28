<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\CQRS\ClassCommand;
use App\CQRS\CommandInterface;

class SearchWeather implements CommandInterface
{
    use ClassCommand;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $city;

    public function __construct(string $country, string $city)
    {
        $this->country = $country;
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
