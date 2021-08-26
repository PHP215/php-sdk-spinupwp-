<?php

namespace DeliciousBrains\SpinupWp\Endpoints;

use DeliciousBrains\SpinupWp\Resources\Site as SiteResource;

class Site extends Endpoint
{
    public function all(): array
    {
        $sites = $this->getRequest('sites');

        return $this->transformCollection($sites['data'], SiteResource::class);
    }

    public function get(int $id): SiteResource
    {
        $site = $this->getRequest("sites/{$id}");

        return new SiteResource($site['data'], $this);
    }

    public function create(int $serverId, array $data): SiteResource
    {
        $site = $this->postRequest('sites', array_merge($data, [
            'server_id' => $serverId,
        ]));

        return new SiteResource($site['data'], $this);
    }

    public function delete(int $id): void
    {
        $this->deleteRequest("sites/{$id}");
    }
}