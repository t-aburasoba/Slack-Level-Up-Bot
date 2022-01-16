<?php

namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackReactionService
{
    public function calculateExperience(array $event)
    {
        Log::info($event['reaction']); // 押されたリアクション
        Log::info($event['user']); // 入力したユーザーの ID
        return true;
    }
}
