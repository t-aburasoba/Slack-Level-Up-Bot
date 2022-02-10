<?php

namespace App\Services\Slack;

use App\Constants\SlackConst;
use App\Repositories\Workspace\WorkspaceRepositoryInterface;
use App\Services\LevelUpService;
use Illuminate\Support\Facades\Log;

class WorkspaceService
{
    /**
     * @var $workspaceRepository;
     */
    protected $workspaceRepository;

    /**
     * @param WorkspaceRepositoryInterface $workspaceRepository
     */
    public function __construct(
        WorkspaceRepositoryInterface $workspaceRepository
    ) {
        $this->workspaceRepository = $workspaceRepository;
    }

    public function create(string $teamId, string $channelId, string $token)
    {
        $this->workspaceRepository->create($teamId, $channelId, $token);
    }
}
