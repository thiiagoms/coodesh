<?php

namespace App\Services\Status;

use App\Repositories\Status\StatusRepository;
use App\Contracts\Domain\Status\StatusContract;
use Illuminate\Database\Eloquent\Collection;

class StatusService implements StatusContract
{
    /**
     * @param StatusRepository $statusRepository
     */
    public function __construct(private StatusRepository $statusRepository)
    {
    }

    /**
     * @param array $params
     * @return array
     */
    public function getParams(array $params): array
    {
        return ['id' => $params['id'], 'name' => $params['name']];
    }

    /**
     * @param array $params
     * @return array
     */
    public function setParams(array $params): array
    {
        return [
            'status_id' => $params['id'],
            'description' => $params['name']
        ];
    }

    public function find(string $uuid): null|Collection
    {
        $status = $this->statusRepository->find($uuid);
        dd($status);
    }

    /**
     * @param array $params
     * @return string
     */
    public function store(array $params): string
    {
        return $this->statusRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->statusRepository->update($uuid, $this->setParams($params));
    }

    public function delete(string $uuid): void
    {
        $this->statusRepository->delete($uuid);
    }
}
