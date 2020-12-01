<?php

declare(strict_types=1);

namespace App\CQRS;

use Psr\Container\ContainerInterface;
use App\Application\Query\Query;

final class Queries
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get(string $className): Query
    {
        $queryView = $this->getViewName($className);

        if ($this->container->has($queryView)) {
            return $this->container->get($queryView);
        }

        throw new \Exception(\sprintf('Missing query %s', $className));
    }

    private function getViewName(string $className): string
    {
        $queryView = str_replace('App\Application\Query', 'App\Infrastructure\Doctrine\Dbal', $className);

        return str_replace('Query', 'View', $queryView);
    }
}
