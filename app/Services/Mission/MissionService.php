<?php

namespace App\Services\Mission;

use App\Contracts\Domain\Mission\MissionContract;
use App\Repositories\Mission\MissionRepository;
use Illuminate\Database\Eloquent\Collection;

class MissionService implements MissionContract
{
    public function __construct(
        private OrbitService $orbitService,
        private MissionRepository $missionRepository
    ) {
    }

    public function getParams(array $params)
    {
        return [
            'id'                => $params['id'],
            'launch_library_id' => $params['launch_library_id'],
            'name'              => $params['name'],
            'description'       => $params['description'],
            'launch_designator' => $params['launch_designator'],
            'type'              => $params['type'],
            'orbit'             => $this->orbitService->getParams($params['orbit'])
        ];
    }

    private function setParams(array $params)
    {
        return [
            'mission_id'        => $params['id'],
            'launch_library_id' => $params['launch_library_id'],
            'name'              => $params['name'],
            'description'       => $params['description'],
            'launch_designator' => $params['launch_designator'],
            'type'              => $params['type'],
            'orbit_id'          => $this->orbitService->createOrUpdate($params['orbit'])
        ];
    }

    /**
     * @param string $uuid
     * @return Collection|null
     */
    public function getOrbit(string $uuid): null|Collection
    {
        // TODO: Implement getOrbit() method.
        return null;
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
        return $this->missionRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->missionRepository->update($uuid, $this->setParams($params));
    }


    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $mission = $this->missionRepository->find($uuid);

        $this->orbitService->delete($mission->orbit_id);
        $this->missionRepository->delete($uuid);
    }
}
