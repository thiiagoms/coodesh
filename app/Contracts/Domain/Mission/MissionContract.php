<?php

declare(strict_types=1);

namespace App\Contracts\Domain\Mission;

use App\Contracts\Contract;
use Illuminate\Database\Eloquent\Collection;

interface MissionContract extends Contract
{
    public function getOrbit(string $uuid): null|Collection;
}
