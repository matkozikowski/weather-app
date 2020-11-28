<?php

namespace App\Infrastructure\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Weathers;
use App\Domain\Model\Weather;

class DoctrineWeather implements Weathers
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Weather $weather): void
    {
        $this->entityManager->persist($weather);
        $this->entityManager->flush();
    }
}