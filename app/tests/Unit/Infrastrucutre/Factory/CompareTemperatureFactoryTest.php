<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Factory;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Factory\CompareTemperatureFactory;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class CompareTemperatureFactoryTest extends TestCase
{
    /**
     * @dataProvider temperaturesProvider
     */
    public function test_compare_emperature(array $data, float $expected)
    {
        $temperatures = new ArrayCollection($data);

        $factory = new CompareTemperatureFactory();

        $this->assertEquals($expected, $factory->create($temperatures));
    }

    public function temperaturesProvider(): array
    {
        return [
            [
                [25, 27], '26.0'
            ],
            [
                [5, -2], '1.5'
            ],
            [
                [-3, -2], '-2.5'
            ],
            [
                [5, 4, 2], '3.7'
            ],
        ];
    }
}
