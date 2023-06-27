<?php

declare(strict_types=1);

namespace App\Repositories\Mission;

use App\Repositories\Repository;
use App\Models\Mission;

class MissionRepository extends Repository
{
    /** @var Mission */
    protected $model = Mission::class;
}
