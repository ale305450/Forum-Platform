<?php

namespace App\Policies;

use App\Core\Entities\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function modify(User $user, User $model)
    {
        return $user->id === $model->id;
    }
}
