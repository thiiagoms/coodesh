<?php

namespace App\Services\Provider;

use App\Contracts\Domain\Provider\ProviderContract;
use App\Repositories\Provider\ProviderRepository;
use Illuminate\Database\Eloquent\Collection;

class ProviderService implements ProviderContract
{
    /**
     * @param ProviderRepository $providerRepository
     */
    public function __construct(private ProviderRepository $providerRepository)
    {
    }

    /**
     * @param array $params
     * @return array
     */
    public function getParams(array $params): array
    {
        return [
            'id'   => $params['id'],
            'url'  => $params['url'],
            'name' => $params['name'],
            'type' => $params['type']
        ];
    }

    private function setParams(array $params): array
    {
        return [
            'provider_id' => $params['id'],
            'url'  => $params['url'],
            'name' => $params['name'],
            'type' => $params['type']
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
        return $this->providerRepository->store($this->setParams($params));
    }

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void
    {
        $this->providerRepository->update($uuid, $this->setParams($params));
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $this->providerRepository->delete($uuid);
    }
}
