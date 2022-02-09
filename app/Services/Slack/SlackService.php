<?php

namespace App\Services\Slack;

use App\Constants\SlackConst;
use App\Services\LevelUpService;
use Illuminate\Support\Facades\Log;

class SlackService
{
    /**
     * @var $slackMessageService;
     */
    protected $slackMessageService;
    
    /**
     * @var $slackReactionService;
     */
    protected $slackReactionService;
    
    /**
     * @var $levelUpService;
     */
    protected $levelUpService;

    /**
     * @param SlackMessageService $slackMessageService
     * @param SlackReactionService $slackReactionService
     * @param LevelUpService $levelUpService
     */
    public function __construct(
        SlackMessageService $slackMessageService,
        SlackReactionService $slackReactionService,
        LevelUpService $levelUpService
    ) {
        $this->slackMessageService = $slackMessageService;
        $this->slackReactionService = $slackReactionService;
        $this->levelUpService = $levelUpService;
    }

    public function levelUp(array $event)
    {
        $eventType = $event['type'];
        $eventSubType = isset($event['subtype']) ? $event['subtype'] : null;

        if ($eventType === SlackConst::EVENT_MESSAGE && $eventSubType !== SlackConst::EVENT_MESSAGE_CHANGED && $eventSubType !== SlackConst::EVENT_BOT_MESSAGE) {
            $experience = $this->slackMessageService->calculateExperience($event);
        } elseif ($eventType === SlackConst::EVENT_REACTION_ADDED) {
            $experience = $this->slackReactionService->calculateExperience($event);
        } else {
            return false;
        }
        $slackId = $event['user'];
        $this->updateExperience($slackId, $experience);
        return true;
    }

    public function updateExperience(string $slackId, int $experience)
    {
        return $this->levelUpService->levelUp($slackId, $experience);
    }
}
