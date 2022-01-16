<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SlackController extends Controller
{
    public function receiveMessage(Request $request)
    {
        if ($request->input('type') == 'url_verification') {
            return $request->input('challenge');
        }

        $input = $request->input();
        Log::info($input);
        Log::info($input['event']['type']); // 'reaction_added' or 'message'
        $input['event']['subtype']; //'message_changed' want to ignore
        Log::info($input['event']['text']); // 入力したテキスト
        Log::info($input['event']['user']); // 入力したユーザーの ID
        $isBot = $input['authorizations'][0]['is_bot'];
        if ($isBot) {
            Log::info('bot だよ');
        } else {
            Log::info('botじゃない');
        }
        return '';
    }
}
