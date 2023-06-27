<?php

namespace App\Services\Rocket;

use App\Contracts\Domain\Rocket\ConfigurationContract;
use App\Repositories\Configuration\ConfigurationRepository;
use Illuminate\Database\Eloquent\Collection;

class ConfigurationService implements ConfigurationContract
{
    public function __construct(private ConfigurationRepository $configurationRepository)
    {
    }

    /**
     * @param array $params
     * @return array
     */
    public function getParams(array $params): array
    {
        return [
            'id'     => $params['id'],
            'url'    => $params['url'],
            'name'   => $params['name'],
            'family' => $params['family'],
            'full_name' => $params['full_name'],
            'variant' => $params['variant']
        ];
    }

    /**
     * @param array $params
     * @return array
     */
    private function setParams(array $params): array
    {
        return [
            'configuration_id' => $params['id'],
            'url'       => $params['url'],
            'name'      => $params['name'],
            'family'    => $params['family'],
            'full_name' => $params['full_name'],
            'variant'   => $params['variant']
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
        return $this->configurationRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->configurationRepository->update($uuid, $this->setParams($params));
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
        // TODO: Implement delete() method.
    }
}
