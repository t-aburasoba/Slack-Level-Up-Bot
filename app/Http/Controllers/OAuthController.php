<?php

namespace App\Http\Controllers;

use App\Services\Slack\WorkspaceService;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    const SLACK_OAUTH_URL = 'https://slack.com/api/oauth.v2.access';

    /**
     * @var $workspaceService;
     */
    protected $workspaceService;

    /**
     * @param WorkspaceService $workspaceService
     */
    public function __construct(
        WorkspaceService $workspaceService
    ) {
        $this->workspaceService = $workspaceService;
    }
    //Slackのredirect_urlからコールバックされるメソッド
    public function redirect(Request $request)
    {
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
        $option['form_params']= $params;

        $response = $guzzle->post(self::SLACK_OAUTH_URL, $option);
        $body = $response->getBody();

        $data = json_decode((String)$body, true);
        if (!$data['ok']) {
            return response('OAuth request returns error!', 500);
        }
        $token = $data['access_token'];
        $channelId = $data['incoming_webhook']['channel_id'];
        $teamId = $data['team']['id'];

        $this->workspaceService->create($teamId, $channelId, $token);

        return redirect()->route('top')->with('message', 'Thank you for installing');
    }
}
