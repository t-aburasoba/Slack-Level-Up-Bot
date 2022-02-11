<?php

namespace App\Http\Controllers;

use App\Services\LevelUpService;
use Illuminate\Http\Request;
use App\Constants\SlackConst;
use App\Services\LevelCheckService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Slack\SlackService;

class SlackController extends Controller
{
    /**
     * @var $slackService;
     */
    protected $slackService;

    /**
     * @var $levelCheckService;
     */
    protected $levelCheckService;

    /**
     * @var $levelUpService;
     */
    protected $levelUpService;

    /**
     * @param SlackService $slackService
     * @param LevelCheckService $levelCheckService
     * @param LevelUpService $levelUpService
     */
    public function __construct(
        SlackService $slackService,
        LevelCheckService $levelCheckService,
        LevelUpService $levelUpService
    ) {
        $this->slackService = $slackService;
        $this->levelCheckService = $levelCheckService;
        $this->levelUpService = $levelUpService;
    }

    public function receiveMessage(Request $request)
    {
        if ($request->input('type') === 'url_verification') {
            return $request->input('challenge');
        }

        $input = $request->input();
        $teamId = $input['team_id'];
        $event = $input['event'];
        $eventSubType = isset($event['subtype']) ? $event['subtype'] : null;
        $isBot = $input['authorizations'][0]['is_bot'];
        $botId = isset($event['bot_id']);
        if ($isBot || $eventSubType === SlackConst::EVENT_BOT_MESSAGE || $eventSubType === SlackConst::EVENT_MESSAGE || $botId) {
            return '';
        }
        $this->slackService->levelUp($event, $teamId);
        return '';
    }

    public function checkLevel(Request $request)
    {
        list($level, $experience) = $this->levelCheckService->checkLevelAndExperience($request->input('user_id'));
        $nextTotalExperience = $this->levelUpService->getNextTotalExperience($level);
        $needExperienceToNextLevel = $nextTotalExperience - $experience;
        return response()->json([
            'text' => 'あなたのレベルは ' . $level . ' です。次のレベルアップには ' . $needExperienceToNextLevel . ' 経験値必要です。'
        ]);
    }
}
