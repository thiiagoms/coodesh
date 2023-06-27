<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Infra\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository factory
 *
 * @package App\Repositories
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
abstract class Repository implements RepositoryContract
{
    protected $model;

    /**
     * @return mixed
     */
    private function handler(): mixed
    {
        return app($this->model);
    }

    public function __construct()
    {
        $this->model = $this->handler();
    }

    /**
     * @param string $uuid
     */
    public function find(string $uuid)
    {
        return $this->model->find($uuid);
    }

    /**
     * @param array $params
     * @return string
     */
    public function store(array $params): string
    {
        return $this->model->create($params)->id;
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->model->where('id', $uuid)->update($params);
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $this->model->destroy($uuid);
    }
}
