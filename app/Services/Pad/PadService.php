<?php

namespace App\Services\Pad;

use App\Contracts\Domain\Pad\PadContract;
use App\Repositories\Pad\PadRepository;
use Illuminate\Database\Eloquent\Collection;

class PadService implements PadContract
{
    public function __construct(private LocationService $locationService, private PadRepository $padRepository)
    {
    }

    public function getParams(array $params): array
    {
        return [
            'id' => $params['id'],
            'url' => $params['url'],
            'agency_id' => $params['agency_id'],
            'name' => $params['name'],
            'info_url' => $params['info_url'],
            'wiki_url' => $params['wiki_url'],
            'map_url'   => $params['map_url'],
            'latitude' => $params['latitude'],
            'longitude' => $params['longitude'],
            'location'  => $this->locationService->getParams($params['location']),
            'map_image' => $params['map_image'],
            'total_launch_count' => $params['total_launch_count']
        ];
    }

    private function setParams(array $params): array
    {
        return [
            'pad_id' => $params['id'],
            'url' => $params['url'],
            'agency_id' => $params['agency_id'],
            'name' => $params['name'],
            'info_url' => $params['info_url'],
            'wiki_url' => $params['wiki_url'],
            'map_url' => $params['map_url'],
            'latitude' => $params['latitude'],
            'longitude' => $params['longitude'],
            'location_id' => $this->locationService->createOrUpdate($params['location']),
            'map_image' => $params['map_image'],
            'total_launch_count' => $params['total_launch_count']
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
        return $this->padRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->padRepository->update($uuid, $this->setParams($params));
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $pad = $this->padRepository->find($uuid);

        $this->locationService->delete($pad->location_id);
        $this->padRepository->delete($pad->id);
    }

    /**
     * @param string $uuid
     * @return Collection|null
     */
    public function getLocation(string $uuid): null|Collection
    {
        // TODO: Implement getLocation() method.
        return null;
    }
}
