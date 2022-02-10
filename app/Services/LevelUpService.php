<?php
namespace App\Services;

use App\Services\Slack\SlackSendMessageService;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\LevelsExperience\LevelsExperienceRepositoryInterface;
use Illuminate\Support\Facades\Log;

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
     * @param UserRepositoryInterface $userRepository
     * @param LevelsExperienceRepositoryInterface $levelsExperienceRepository
     * @param SlackSendMessageService $slackSendMessageService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        LevelsExperienceRepositoryInterface $levelsExperienceRepository,
        SlackSendMessageService $slackSendMessageService
    ) {
        $this->userRepository = $userRepository;
        $this->levelsExperienceRepository = $levelsExperienceRepository;
        $this->slackSendMessageService = $slackSendMessageService;
    }

    public function levelUp(string $slackId, int $experience, string $teamId)
    {
        $user = $this->userRepository->getBySlackId($slackId);
        $data = [];
        if (!$user->workspace_id) {
            $data['workspace_id'] = $teamId;
        }
        $totalExperience = $user->total_experiences + $experience;
        $level = $this->getLevel($totalExperience, $user);
        $data['total_experiences'] = $totalExperience;
        $data['level'] = $level;
        return $this->userRepository->update($data, $slackId);
    }

    public function getLevel($totalExperience, $user)
    {
        $nextLevel = $user->level + 1;
        $levelsExperience = $this->levelsExperienceRepository->getByLevel($nextLevel);
        $nextTotalExperience = $levelsExperience->total_experiences;
        if ($nextTotalExperience <= $totalExperience) {
            $this->slackSendMessageService->sendMessage('<@' . $user->slack_id . '> のレベルが ' . $nextLevel . ' にアップしました !!!');
            return $nextLevel;
        }
        return $user->level;
    }
}
