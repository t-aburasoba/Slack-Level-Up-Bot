<?php

namespace App\Services\Slack;

use App\Constants\SlackConst;
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
     * @param SlackMessageService $slackMessageService
     * @param SlackReactionService $slackReactionService
     */
    public function __construct(
        SlackMessageService $slackMessageService,
        SlackReactionService $slackReactionService
    ) {
        $this->slackMessageService = $slackMessageService;
        $this->slackReactionService = $slackReactionService;
    }

    public function levelUp(array $event)
    {
        $eventType = $event['type'];
        $eventSubType = isset($event['subtype']) ? $event['subtype'] : null;
        Log::info($eventType . ' の ' . $eventSubType);

        if ($eventType === SlackConst::EVENT_MESSAGE && $eventSubType !== SlackConst::EVENT_MESSAGE_CHANGED) {
            $this->slackMessageService->levelUpByMessage($event);
        } elseif ($eventType === SlackConst::EVENT_REACTION_ADDED) {
            $this->slackReactionService->levelUpByReaction($event);
        } else {
            return false;
        }
        return true;
    }
}
