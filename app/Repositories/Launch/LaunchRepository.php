<?php

declare(strict_types=1);

namespace App\Repositories\Launch;

use App\Models\Launch;
use App\Repositories\Repository;

class LaunchRepository extends Repository
{
    /** @var Launch */
    protected $model = Launch::class;

    private const PAGINATE = 1;

    public function index()
    {
        return $this->model->with([
            'status', 'provider', 'rocket',
            'mission', 'pad'
        ])->paginate(self::PAGINATE);
    }
}
