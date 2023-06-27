<?php

declare(strict_types=1);

namespace App\Contracts\Domain\Pad;

use App\Contracts\Contract;
use Illuminate\Database\Eloquent\Collection;

interface PadContract extends Contract
{
    public function getLocation(string $uuid): null|Collection;
}
