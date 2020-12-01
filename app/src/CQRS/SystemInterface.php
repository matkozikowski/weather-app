<?php

declare(strict_types=1);

namespace App\CQRS;

use App\Application\Query\Query;

interface SystemInterface
{
    public function handle(CommandInterface $command): void;

    public function query(string $queryClass): Query;
}
