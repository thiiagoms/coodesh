<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Launch\LaunchRepository;
use App\Services\Mission\MissionService;
use App\Services\Pad\PadService;
use App\Services\Provider\ProviderService;
use App\Services\Rocket\RocketService;
use App\Services\Status\StatusService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaunchService
{
    public function __construct(
        private StatusService $statusService,
        private RocketService $rocketService,
        private MissionService $missionService,
        private PadService $padService,
        private ProviderService $providerService,
        private LaunchRepository $launchRepository
    ) {
    }

    /**
     * Get Params from request
     *
     * @param array $params
     * @return array
     */
    private function getParams(array $params): array
    {
        return [
            'id'  => $params['id'],
            'url' => $params['url'],
            'launch_library_id' => $params['launch_library_id'],
            'slug'    => $params['slug'],
            'name'    => $params['name'],
            'status'  => $this->statusService->getParams($params['status']),
            'net'          => $params['net'],
            'window_end'   => $params['window_end'],
            'window_start' => $params['window_start'],
            'inhold'       => $params['inhold'],
            'tbdtime'      => $params['tbdtime'],
            'tbddate'      => $params['tbddate'],
            'probability'  => $params['probability'],
            'holdreason'   => $params['holdreason'],
            'failreason'   => $params['failreason'],
            'hashtag' => $params['hashtag'],
            'launch_service_provider' => $this->providerService->getParams($params['launch_service_provider']),
            'rocket'  => $this->rocketService->getParams($params['rocket']),
            'mission' => !is_null($params['mission']) ? $this->missionService->getParams($params['mission']) : null,
            'pad'     => $this->padService->getParams($params['pad']),
            'webcast_live'  => $params['webcast_live'],
            'image'         =>  $params['image'],
            'infographic'   =>  $params['infographic'],
        ];
    }

    /**
     * Prepare params to insert
     *
     * @param array $params
     * @return array
     */
    private function setParams(array $params): array
    {
        $params['window_end'] = Carbon::parse($params['window_end'])->format('Y-m-d H:i:s');
        $params['window_start'] = Carbon::parse($params['window_start'])->format('Y-m-d H:i:s');

        $params['status_id'] = $this->statusService->store($params['status']);

        $params['provider_id'] = $this->providerService->store($params['launch_service_provider']);

        $params['rocket_id'] = $this->rocketService->store($params['rocket']);

        $params['mission_id'] = !is_null($params['mission']) ? $this->missionService->store($params['mission']) : null;
        $params['pad_id'] = $this->padService->store($params['pad']);

        unset($params['status']);
        unset($params['launch_service_provider']);
        unset($params['rocket']);
        unset($params['mission']);
        unset($params['pad']);

        return $params;
    }

    public function index()
    {
//        DB::enableQueryLog();
        $launchs = $this->launchRepository->index();
//        dd($launchs);
        $results = $launchs->map(fn ($launch) =>  [
            'id'  => $launch->id,
            'url' => $launch->url,
            'launch_library_id' => $launch->launch_library_id,
            'slug' => $launch->slug,
            'name' => $launch->name,
            'status' => [
                'id' => $launch->status->status_id,
                'name' => $launch->status->description
            ],
            'net'          => $launch->net,
            'window_end'   => $launch->window_end,
            'window_start' => $launch->window_start,
            'inhold'       => $launch->inhold,
            'tbdtime'      => $launch->tbdtime,
            'tbddate'      => $launch->tbddate,
            'probability'  => $launch->probability,
            'holdreason'   => $launch->holdreason,
            'failreason'   => $launch->failreason,
            'hashtag' => $launch->hashtag,
            'launch_service_provider' => [
                'id' => $launch->provider->provider_id,
                'url'  => $launch->url,
                'name' => $launch->name,
                'type' => $launch->type
            ],
            'rocket' => [
                'id' => $launch->rocket->rocket_id,
                'configuration' => [
                    'id'        => $launch->rocket->configuration->configuration_id,
                    'url'       => $launch->rocket->configuration->url,
                    'name'      => $launch->rocket->configuration->name,
                    'family'    => $launch->rocket->configuration->family,
                    'full_name' => $launch->rocket->configuration->full_name,
                    'variant'   => $launch->rocket->configuration->variant
                ]
            ],
            'mission' => !is_null($launch->mission) ? [
                'id'                => $launch->mission->mission_id,
                'launch_library_id' => $launch->mission->launch_library_id,
                'name'        => $launch->mission->name,
                'description' => $launch->mission->description,
                'launch_designator' => $launch->mission->launch_designator,
                'type'  => $launch->mission->type,
                'orbit' => [
                    'id'   => $launch->mission->orbit->orbit_id,
                    'name' => $launch->mission->orbit->name,
                    'abbrev' => $launch->mission->orbit->abbrev
                ]
            ]
                : $launch->mission,
            'pad' => [
                'id'  => $launch->pad->pad_id,
                'url' => $launch->pad->url,
                'agency_id' => $launch->pad->agency_id,
                'name'      => $launch->pad->name,
                'info_url'  => $launch->pad->info_url,
                'wiki_url'  => $launch->pad->wiki_url,
                'map_url'   => $launch->pad->map_url,
                'latitude'  => $launch->pad->latitude,
                'longitude' => $launch->pad->longitude,
                'location' => [
                    'id'   => $launch->pad->location->location_id,
                    'url'  => $launch->pad->location->url,
                    'name' => $launch->pad->location->name,
                    'country_code' => $launch->pad->location->country_code,
                    'map_image'    => $launch->pad->location->map_image,
                    'total_launch_count'  => $launch->pad->location->total_launch_count,
                    'total_landing_count' => $launch->pad->location->total_landing_count,
                ],
                'map_image' => $launch->pad->map_image,
                'total_launch_count' => $launch->pad->total_launch_count
            ],
            'webcast_live' => $launch->webcast_live,
            'image' => $launch->image,
            'infographic' => $launch-> infographic,
        ]);

        return $results;
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function show(string $uuid)
    {
        $launch = $this->launchRepository->find($uuid);

        // Muita responsabilidade em um metodo apenas e refatorar com o eagle loadinh
        return [
            'id'  => $launch->id,
            'url' => $launch->url,
            'launch_library_id' => $launch->launch_library_id,
            'slug' => $launch->slug,
            'name' => $launch->name,
            'status' => [
                'id' => $launch->status->status_id,
                'name' => $launch->status->description
            ],
            'net'          => $launch->net,
            'window_end'   => $launch->window_end,
            'window_start' => $launch->window_start,
            'inhold'       => $launch->inhold,
            'tbdtime'      => $launch->tbdtime,
            'tbddate'      => $launch->tbddate,
            'probability'  => $launch->probability,
            'holdreason'   => $launch->holdreason,
            'failreason'   => $launch->failreason,
            'hashtag' => $launch->hashtag,
            'launch_service_provider' => [
                'id' => $launch->provider->provider_id,
                'url'  => $launch->url,
                'name' => $launch->name,
                'type' => $launch->type
            ],
            'rocket' => [
                'id' => $launch->rocket->rocket_id,
                'configuration' => [
                    'id'        => $launch->rocket->configuration->configuration_id,
                    'url'       => $launch->rocket->configuration->url,
                    'name'      => $launch->rocket->configuration->name,
                    'family'    => $launch->rocket->configuration->family,
                    'full_name' => $launch->rocket->configuration->full_name,
                    'variant'   => $launch->rocket->configuration->variant
                ]
            ],
            'mission' => !is_null($launch->mission) ? [
                   'id'                => $launch->mission->mission_id,
                   'launch_library_id' => $launch->mission->launch_library_id,
                   'name'        => $launch->mission->name,
                   'description' => $launch->mission->description,
                   'launch_designator' => $launch->mission->launch_designator,
                   'type'  => $launch->mission->type,
                   'orbit' => [
                       'id'   => $launch->mission->orbit->orbit_id,
                       'name' => $launch->mission->orbit->name,
                       'abbrev' => $launch->mission->orbit->abbrev
                   ]
                ]
                : $launch->mission,
            'pad' => [
                'id'  => $launch->pad->pad_id,
                'url' => $launch->pad->url,
                'agency_id' => $launch->pad->agency_id,
                'name'      => $launch->pad->name,
                'info_url'  => $launch->pad->info_url,
                'wiki_url'  => $launch->pad->wiki_url,
                'map_url'   => $launch->pad->map_url,
                'latitude'  => $launch->pad->latitude,
                'longitude' => $launch->pad->longitude,
                'location' => [
                    'id'   => $launch->pad->location->location_id,
                    'url'  => $launch->pad->location->url,
                    'name' => $launch->pad->location->name,
                    'country_code' => $launch->pad->location->country_code,
                    'map_image'    => $launch->pad->location->map_image,
                    'total_launch_count'  => $launch->pad->location->total_launch_count,
                    'total_landing_count' => $launch->pad->location->total_landing_count,
                ],
                'map_image' => $launch->pad->map_image,
                'total_launch_count' => $launch->pad->total_launch_count
            ],
            'webcast_live' => $launch->webcast_live,
            'image' => $launch->image,
            'infographic' => $launch-> infographic,
        ];
    }

    //TODO: REFATORAR COM OS JOBS
    public function store(array $params): void
    {
        $launchs = [];

        foreach ($params as $param) {
            $launchs[] = $this->getParams($param);
        }

        /**
         * TODO: Criar um Job para executar cada insert
         *  evitando que o usuario envie mutiplos arquivos e sobrecarregue a api
         */
        foreach ($launchs as $launch) {
            DB::transaction(function () use ($launch) {
                $this->launchRepository->store($this->setParams($launch));
            });
        }
    }

    //TODO:
    public function update(string $uuid, array $params)
    {
        $launch = $this->launchRepository->find($uuid);
        $params = $this->getParams($params);

        DB::transaction(function () use ($launch, $params) {
            $data = [
                'url' => $params['url'],
                'launch_library_id' => $params['launch_library_id'],
                'slug' => $params['slug'],
                'name' => $params['name'],
                'net'  => $params['net'],
                'window_end' => Carbon::parse($params['window_end'])->format('Y-m-d H:i:s'),
                'window_start' => Carbon::parse($params['window_start'])->format('Y-m-d H:i:s'),
                'inhold'  => $params['inhold'],
                'tbdtime' => $params['tbdtime'],
                'tbddate' => $params['tbddate'],
                'probability' => $params['probability'],
                'holdreason' => $params['holdreason'],
                'failreason' => $params['failreason'],
                'hashtag' => $params['hashtag'],
                'webcast_live' => $params['webcast_live'],
                'image'        =>  $params['image'],
                'infographic'  =>  $params['infographic'],
            ];

            $this->launchRepository->update($launch->id, $data);

            $this->statusService->update($launch->status->id, $params['status']);
            $this->providerService->update($launch->provider->id, $params['launch_service_provider']);
            $this->rocketService->update($launch->rocket->id, $params['rocket']);
            !is_null($params['mission'])
                ? $this->missionService->update($launch->mission->id, $params['mission']) : null;
            $this->padService->update($launch->pad->id, $params['pad']);
        });
    }

    // TODO: Muita responsabilidade em um metodo apenas
    public function destroy(string $uuid): void
    {
        $launch = $this->launchRepository->find($uuid);

        DB::transaction(function () use ($launch) {
            $this->launchRepository->delete($launch->id);
            $this->statusService->delete($launch->status_id);

            $this->providerService->delete($launch->provider_id);

            $this->rocketService->delete($launch->rocket_id);

            !is_null($launch->missio_id) ? $this->missionService->delete($launch->mission_id) : null;

            $this->padService->delete($launch->pad_id);
        });
    }
}
