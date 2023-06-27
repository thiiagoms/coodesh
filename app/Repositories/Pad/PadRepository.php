<?php

declare(strict_types=1);

namespace App\Repositories\Pad;

use App\Repositories\Repository;
use App\Models\Pad;

class PadRepository extends Repository
{
    /** @var Pad */
    protected $model = Pad::class;
}
