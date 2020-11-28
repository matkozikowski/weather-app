<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Factory;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Factory\TemperatureFactory;

class TemperatureFactoryTest extends TestCase
{
    public function test_calculation_temperature()
    {
        $factory = new TemperatureFactory();

        $this->assertEquals(-3.15, $factory->create(270));
    }
}
