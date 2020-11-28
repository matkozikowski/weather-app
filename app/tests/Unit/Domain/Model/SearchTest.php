<?php

declare(strict_types=1);

namespace App\Tests\Domain\Model;

use App\Domain\Model\Search;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function test_makes_weathers_data_lowercase() : void
    {
        $search = new Search('POLAND', 'OSTROWO');

        $this->assertThat($search->country(), new IsEqual('poland'));
        $this->assertThat($search->city(), new IsEqual('ostrowo'));
    }

    public function test_min_country_value(): void
    {
        $this->expectExceptionMessage('Country require length min 2');

        new Search('P', 'OSTROWO');
    }

    public function test_min_city_value(): void
    {
        $this->expectExceptionMessage('City require length min 2');

        new Search('POLAND', 'O');
    }
}
