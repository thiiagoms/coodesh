<?php

declare(strict_types=1);

namespace App\Repositories\Provider;

use App\Repositories\Repository;
use App\Models\Provider;

class ProviderRepository extends Repository
{
    /** @var Provider */
    protected $model = Provider::class;
}
