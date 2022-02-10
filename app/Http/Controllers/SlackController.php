<?php

namespace App\Http\Controllers;

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
     * @param SlackService $slackService
     * @param LevelCheckService $levelCheckService
     */
    public function __construct(
        SlackService $slackService,
        LevelCheckService $levelCheckService
    ) {
        $this->slackService = $slackService;
        $this->levelCheckService = $levelCheckService;
    }

    public function receiveMessage(Request $request)
    {
        if ($request->input('type') == 'url_verification') {
            return $request->input('challenge');
        }

        $input = $request->input();
        $teamId = $input['team_id'];
        $event = $input['event'];
        $eventSubType = isset($event['subtype']) ? $event['subtype'] : null;
        $isBot = $input['authorizations'][0]['is_bot'];
        if ($isBot || $eventSubType === SlackConst::EVENT_BOT_MESSAGE|| $eventSubType === SlackConst::EVENT_MESSAGE) {
            return '';
        }
        $this->slackService->levelUp($event, $teamId);
        return '';
    }

    public function checkLevel(Request $request)
    {
        $level = $this->levelCheckService->checkLevel($request->input('user_id'));
        return response()->json(['text' => 'あなたのレベルは ' . $level . ' です。']);
    }
}
