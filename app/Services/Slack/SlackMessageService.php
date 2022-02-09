<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackMessageService
{
    const EXPERIENCE_MAGNIFICATION = 5;
    public function calculateExperience(array $event)
    {
        $textNumber = mb_strlen($event['text']);
        $experience = floor($textNumber/self::EXPERIENCE_MAGNIFICATION);
        return $experience;
    }
}
