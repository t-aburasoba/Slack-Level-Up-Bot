<?php

namespace App\Repositories\Workspace;

use App\Models\Workspace;

class WorkspaceRepository implements WorkspaceRepositoryInterface
{
    public function create(string $channelId, string $token)
    {
        return Workspace::firstOrCreate(
            ['channel_id' => $channelId],
            ['access_token' => $token]
        );
    }
}
