<?php

declare(strict_types=1);

namespace App\Repositories\Orbit;

use App\Repositories\Repository;
use App\Models\Orbit;

class OrbitRepository extends Repository
{
    /** @var Orbit */
    protected $model = Orbit::class;
}
