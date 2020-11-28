<?php

declare(strict_types=1);

namespace App\CQRS;

interface QueryInterface
{
    public function find(): array;
}
