<?php

declare(strict_types=1);

namespace App\Services\Rocket;

use App\Contracts\Domain\Rocket\RocketContract;
use App\Repositories\Rocket\RocketRepository;
use Illuminate\Database\Eloquent\Collection;

final class RocketService implements RocketContract
{
    public function __construct(
        private ConfigurationService $configurationService,
        private RocketRepository $rocketRepository
    ) {
    }

    public function getParams(array $params)
    {
        return [
            'id' => $params['id'],
            'configuration' => $this->configurationService->getParams($params['configuration'])
        ];
    }

    public function setParams(array $params): array
    {
        return [
            'rocket_id' => $params['id'],
            'configuration_id' => $this->configurationService->createOrUpdate($params['configuration'])
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
        return $this->rocketRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->rocketRepository->update($uuid, $this->setParams($params));
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $rocket = $this->rocketRepository->find($uuid);

        $this->configurationService->delete($rocket->configuration_id);
        $this->rocketRepository->delete($rocket->id);
    }

    /**
     * @param string $uuid
     * @return Collection
     */
    public function getConfiguration(string $uuid): Collection
    {
        // TODO: Implement getConfiguration() method.
    }
}
