<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getBySlackId(string $slackId);

    public function update(array $data, string $slackId);
}
