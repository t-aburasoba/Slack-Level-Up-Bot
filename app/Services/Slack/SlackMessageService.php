<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackMessageService
{
    public function levelUpByMessage(array $event)
    {
        Log::info($event['text']); // 入力したテキスト
        Log::info($event['user']); // 入力したユーザーの ID
        return true;
    }
}
