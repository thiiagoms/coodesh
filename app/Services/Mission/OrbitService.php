<?php

namespace App\Services\Mission;

use App\Contracts\Domain\Mission\OrbitContract;
use App\Repositories\Orbit\OrbitRepository;
use Illuminate\Database\Eloquent\Collection;

class OrbitService implements OrbitContract
{
    public function __construct(private OrbitRepository $orbitRepository)
    {
    }


    public function getParams(array $params)
    {
        return [
            'id' => $params['id'],
            'name' => $params['name'],
            'abbrev' => $params['abbrev']
        ];
    }

    private function setParams(array $params): array
    {
        return [
            'orbit_id' => $params['id'],
            'name'     => $params['name'],
            'abbrev'   => $params['abbrev']
        ];
    }

    /**
     * @param string $uuid
     * @return Collection|null
     */
    public function find(string $uuid): null|Collection
    {
        // TODO: Implement find() method.
        return null;
    }

    /**
     * @param array $params
     * @return string
     */
    public function store(array $params): string
    {
        return $this->orbitRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->orbitRepository->update($uuid, $this->setParams($params));
    }

    public function createOrUpdate(array $params, string|null $uuid = null)
    {
        return is_null($uuid) ? $this->store($params) : $this->update($uuid, $params);
    }


    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $this->orbitRepository->delete($uuid);
    }
}
