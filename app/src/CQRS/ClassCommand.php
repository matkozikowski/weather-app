<?php

declare(strict_types=1);

namespace App\CQRS;

trait ClassCommand
{
    public function commandName(): string
    {
        return self::class;
    }
}