<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getBySlackId(string $slackId)
    {
        $user = User::firstOrCreate(['slack_id' => $slackId]);
        return $user;
    }

    public function update(array $data, string $slackId)
    {
        $user = $this->getBySlackId($slackId);
        $user->update($data);
        return $user;
    }
}
