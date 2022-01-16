<?php
namespace App\Services\Slack;

class SlackSendMessageService
{
    public function sendMessage(string $message)
    {
        $headers = [
            'Authorization: Bearer xoxb-771687717684-2959803310322-c07qPPiE4R9rUTgpyR9MJBjC', //（1)
            'Content-Type: application/json;charset=utf-8'
        ];
        
        $url = "https://slack.com/api/chat.postMessage"; //(2)
        
        //(3)
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
        
        curl_close($ch);
    }
}