<?php

namespace App\Repositories\Workspace;

interface WorkspaceRepositoryInterface
{
    public function create(string $channelId, string $token);
}
