<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Log;

class SlackSendMessageService
{
    public function sendMessage(string $message)
    {
        try {
            $headers = [
                'Authorization: Bearer ' . config('app.slack-app-token'),
                'Content-Type: application/json;charset=utf-8'
            ];
            
            $url = "https://slack.com/api/chat.postMessage";
            
            $post_fields = [
                "channel" => "#general",
                "text" => $message,
                "as_user" => true
            ];
            
            $options = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($post_fields)
            ];
            
            $ch = curl_init();
            
            curl_setopt_array($ch, $options);
            
            $result = curl_exec($ch);
            
            return curl_close($ch);
        } catch (error $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
