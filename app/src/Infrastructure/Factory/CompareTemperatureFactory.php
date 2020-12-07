<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use Doctrine\Common\Collections\Collection;

use function number_format;

class CompareTemperatureFactory implements FactoryInterface
{
    public function create(Collection $data): string
    {
        return number_format(
            array_sum($data->toArray()) / $data->count(),
            1
        );
    }
}
