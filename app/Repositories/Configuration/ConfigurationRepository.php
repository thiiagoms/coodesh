<?php

declare(strict_types=1);

namespace App\Repositories\Configuration;

use App\Repositories\Repository;
use App\Models\Configuration;

class ConfigurationRepository extends Repository
{
    /** @var Configuration */
    protected $model = Configuration::class;
}
