<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @param SlackService $slackService
     */
    public function __construct(
        SlackService $slackService
    ) {
        $this->slackService = $slackService;
    }

    public function receiveMessage(Request $request)
    {
        if ($request->input('type') == 'url_verification') {
            return $request->input('challenge');
        }

        $input = $request->input();
        $isBot = $input['authorizations'][0]['is_bot'];
        if ($isBot) {
            Log::info('bot だよ');
            return '';
        }
        $event = $input['event'];
        $this->slackService->levelUp($event);
        return '';
    }
}
