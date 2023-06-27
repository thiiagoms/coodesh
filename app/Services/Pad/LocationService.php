<?php

namespace App\Services\Pad;

use App\Contracts\Domain\Pad\LocationContract;
use App\Repositories\Location\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class LocationService implements LocationContract
{
    public function __construct(private LocationRepository $locationRepository)
    {
    }

    public function getParams(array $params): array
    {
        return [
            'id'   => $params['id'],
            'url'  => $params['url'],
            'name' => $params['name'],
            'country_code' => $params['country_code'],
            'map_image'    => $params['map_image'],
            'total_launch_count'  => $params['total_launch_count'],
            'total_landing_count' => $params['total_landing_count'],
        ];
    }

    public function setParams(array $params): array
    {
        return [
            'location_id' => $params['id'],
            'url'  => $params['url'],
            'name' => $params['name'],
            'country_code' => $params['country_code'],
            'map_image'    => $params['map_image'],
            'total_launch_count'  => $params['total_launch_count'],
            'total_landing_count' => $params['total_landing_count'],
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
        return $this->locationRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->locationRepository->update($uuid, $this->setParams($params));
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
        $this->locationRepository->delete($uuid);
    }
}
