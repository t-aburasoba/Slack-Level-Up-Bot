<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Services\Slack\SlackSendMessageService;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Workspace\WorkspaceRepositoryInterface;
use App\Repositories\LevelsExperience\LevelsExperienceRepositoryInterface;

class LevelUpService
{
    /**
     * @var $userRepository;
     */
    protected $userRepository;

    /**
     * @var $levelsExperienceRepository;
     */
    protected $levelsExperienceRepository;

    /**
     * @var $slackSendMessageService;
     */
    protected $slackSendMessageService;

    /**
     * @var $workspaceRepository;
     */
    protected $workspaceRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param LevelsExperienceRepositoryInterface $levelsExperienceRepository
     * @param WorkspaceRepositoryInterface $workspaceRepository
     * @param SlackSendMessageService $slackSendMessageService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        LevelsExperienceRepositoryInterface $levelsExperienceRepository,
        WorkspaceRepositoryInterface $workspaceRepository,
        SlackSendMessageService $slackSendMessageService
    ) {
        $this->userRepository = $userRepository;
        $this->levelsExperienceRepository = $levelsExperienceRepository;
        $this->workspaceRepository = $workspaceRepository;
        $this->slackSendMessageService = $slackSendMessageService;
    }

    public function levelUp(string $slackId, int $experience, string $teamId)
    {
        $user = $this->userRepository->getBySlackId($slackId);
        $data = [];
        if (!$user->workspace_id) {
            $workspaceId = $this->workspaceRepository->getWorkspaceId($teamId);
            $data['workspace_id'] = $workspaceId;
        }
        $totalExperience = $user->total_experiences + $experience;
        $nextTotalExperience = $this->getNextTotalExperience($user->level);
        $level = $user->level;
        if ($nextTotalExperience <= $totalExperience) {
            $level = $user->level + 1;
            $this->slackSendMessageService->sendMessage('<@' . $user->slack_id . '> のレベルが ' . $level . ' にアップしました !!!', $user->workspace->channel_id, $user->workspace->access_token);
        }
        $data['total_experiences'] = $totalExperience;
        $data['level'] = $level;
        return $this->userRepository->update($data, $slackId);
    }

    public function getNextTotalExperience(int $level)
    {
        $nextLevel = $level + 1;
        return $this->levelsExperienceRepository->getByLevel($nextLevel)->total_experiences;
    }
}
