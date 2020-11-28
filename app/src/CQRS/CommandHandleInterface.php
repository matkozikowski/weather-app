<?php

declare(strict_types=1);

namespace App\CQRS;

interface CommandHandleInterface
{
    public function handle(CommandInterface $command): void;
}