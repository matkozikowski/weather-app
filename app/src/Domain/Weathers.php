<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Model\Weather;

interface Weathers
{
    public function add(Weather $weather): void;
}
