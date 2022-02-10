<?php

namespace App\Repositories\Workspace;

use App\Models\Workspace;

class WorkspaceRepository implements WorkspaceRepositoryInterface
{
    public function create(string $teamId, string $channelId, string $token)
    {
        return Workspace::firstOrCreate(
            [
                'team_id' => $teamId
            ],
            [
                'channel_id' => $channelId,
                'access_token' => $token
            ]
        );
    }
}
