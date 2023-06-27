<?php

namespace App\Contracts\Domain\Rocket;

use App\Contracts\Contract;
use Illuminate\Database\Eloquent\Collection;

interface RocketContract extends Contract
{
    public function getConfiguration(string $uuid): Collection;
}
