<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OAuthController extends Controller
{
    const SLACK_OAUTH_URL = 'https://slack.com/api/oauth.v2.access';

    //Slackのredirect_urlからコールバックされるメソッド
    public function redirect(Request $request)
    {
        \Log::info($request);
        $code = $request->input('code');
        $state = $request->input('state');

        if ($request->filled('error')) {
            return response('slack returned error.', 500);
        }

        $guzzle = new \GuzzleHttp\Client();

        $params = [];
        $params['code'] = $code;
        $params['client_id'] = config('app.slack-client-id');
        $params['client_secret'] = config('app.slack-client-secret');

        $option = [];
        $option['form_params']=$params;

        $response = $guzzle->post(self::SLACK_OAUTH_URL, $option);
        $body = $response->getBody();
        \Log::info($body);

        $data = json_decode((String)$body, true);
        if (!$data['ok']) {
            return response('OAuth request returns error!', 500);
        }
        $token = $data['access_token'];
        $userName = $data['user']['name'];
        $userId = $data['user']['id'];
        $teamId = $data['team']['id'];
        \Log::info([$token, $userName, $userId, $teamId]);

        var_dump((String)$body);

        //この先でトークン情報をDBなどに保存しておくこと
        //失うともう一度OAuthする必要がでてくる

        //最後にLaravelのルールでViewの情報を返す。（今回はサンプルなのでOKだけ戻す）
        return redirect()->route('top');
    }
}
