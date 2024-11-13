<?php

namespace App\Policies;

use App\Core\Entities\User;
use App\Core\Entities\Response;

class ResponsePolicy
{
    public function writer(User $user, Response $response)
    {
        return $user->id === $response->user_id;
    }
}
