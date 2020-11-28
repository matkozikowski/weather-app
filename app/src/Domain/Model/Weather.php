<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Webmozart\Assert\Assert;

final class Weather
{
    /***
     * @var integer
     */
    private $id;

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

    public function __construct(Search $search, string $temperature)
    {
        Assert::notEmpty($search->country(), 'Country missing');
        Assert::notEmpty($search->city(), 'City missing');
        Assert::notEmpty($temperature, 'Temperature empty');

        $this->country = $search->country();
        $this->city = $search->city();
        $this->temperature = $temperature;
    }
}
