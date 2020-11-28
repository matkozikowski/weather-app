<?php

declare(strict_types=1);

namespace App\CQRS;

interface CommandInterface
{
    public function commandName() : string;
}