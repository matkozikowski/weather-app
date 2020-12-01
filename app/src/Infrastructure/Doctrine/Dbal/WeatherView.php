<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Dbal;

use App\Application\Query\Model\Weather;
use App\Application\Query\Query;
use Doctrine\DBAL\Connection;

class WeatherView implements Query
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('w.*')
            ->from('weather', 'w')
            ->orderBy('w.id', 'ASC');

        return array_map(
            function (array $weatherData): Weather {
                return new Weather(
                    $weatherData['country'],
                    $weatherData['city'],
                    $weatherData['temperature']
                );
            },
            $qb->execute()->fetchAll()
        );
    }
}
