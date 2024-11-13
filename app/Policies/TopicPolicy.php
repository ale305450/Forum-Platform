<?php

namespace App\Policies;

use App\Core\Entities\Topic;
use App\Core\Entities\User;

class TopicPolicy
{

    public function creator(User $user, Topic $topic)
    {
        return  $user->id === $topic->user_id;
    }
}
