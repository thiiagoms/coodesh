<?php

namespace App\Repositories\Status;

use App\Models\Status\Status;
use App\Repositories\Repository;

/**
 * Status Repository
 *
 * @package App\Repositories
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
class StatusRepository extends Repository
{
    /** @var Status */
    protected $model = Status::class;
}
