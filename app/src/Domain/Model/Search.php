<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Webmozart\Assert\Assert;

final class Search
{
    private const MIN_LENGTH = 2;

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
        Assert::string($country);
        Assert::minLength($country, self::MIN_LENGTH, \sprintf('Country require length min %s', self::MIN_LENGTH));

        Assert::string($city);
        Assert::minLength($city,self::MIN_LENGTH, \sprintf('City require length min %s', self::MIN_LENGTH));

        $this->country = (string) \mb_strtolower($country);;
        $this->city = (string) \mb_strtolower($city);;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function city(): string
    {
        return $this->city;
    }
}
