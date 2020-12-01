<?php

declare(strict_types=1);

namespace App\Application\Query\Model;

class Weather
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $temperature;

    public function __construct(string $country, string $city, string $temperature)
    {
        $this->country = $country;
        $this->city = $city;
        $this->temperature = $temperature;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function temperature(): string
    {
        return $this->temperature;
    }
}
