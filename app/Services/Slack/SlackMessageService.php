<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackMessageService
{
    public function calculateExperience(array $event)
    {
        Log::info($event['text']); // 入力したテキスト
        Log::info($event['user']); // 入力したユーザーの ID
        return mb_strlen($event['text']);
    }
}
