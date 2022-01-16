<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getBySlackId(string $slackId)
    {
        $user = User::where('slack_id', $slackId)->first();
        return $user;
    }

    public function update(array $data, string $slackId)
    {
        $user = $this->getBySlackId($slackId);
        $user->update($data);
        return $user;
    }
}
