<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackMessageService
{
    const EXPERIENCE_MAGNIFICATION = 5;
    public function calculateExperience(array $event)
    {
        Log::info($event['text']); // 入力したテキスト
        Log::info($event['user']); // 入力したユーザーの ID
        $textNumber = mb_strlen($event['text']);
        $experience = floor($textNumber/self::EXPERIENCE_MAGNIFICATION);
        return $experience;
    }
}
