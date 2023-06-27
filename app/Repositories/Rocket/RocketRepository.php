<?php

declare(strict_types=1);

namespace App\Repositories\Rocket;

use App\Repositories\Repository;
use App\Models\Rocket;

class RocketRepository extends Repository
{
    /** @var Rocket */
    protected $model = Rocket::class;
}
