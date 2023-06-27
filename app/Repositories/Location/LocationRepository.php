<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\Repositories\Repository;
use App\Models\Location;

class LocationRepository extends Repository
{
    /** @var Location */
    protected $model = Location::class;
}
