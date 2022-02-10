<?php

namespace App\Repositories\Workspace;

interface WorkspaceRepositoryInterface
{
    public function create(string $teamId, string $channelId, string $token);

    public function getWorkspaceId(string $teamId);
}
