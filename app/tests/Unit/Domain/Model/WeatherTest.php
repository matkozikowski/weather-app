<?php

declare(strict_types=1);

namespace App\Tests\Domain\Model;

use App\Domain\Model\Search;
use App\Domain\Model\Weather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function test_second_value_is_not_empty(): void
    {
        $this->expectExceptionMessage('Temperature empty');

        new Weather(new Search('POLAND', 'OSTROWO'), '');
    }
}
