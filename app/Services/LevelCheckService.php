<?php
namespace App\Services;

use App\Services\Slack\SlackSendMessageService;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\LevelsExperience\LevelsExperienceRepositoryInterface;
use Illuminate\Support\Facades\Log;

class LevelCheckService
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

    public function checkLevel(string $userId)
    {
        $user = $this->userRepository->getBySlackId($userId);
        return $user->level;
    }
}
