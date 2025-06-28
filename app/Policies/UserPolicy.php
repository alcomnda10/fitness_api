<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function updateRole(User $authUser, User $targetUser)
    {
        if ($authUser->id === $targetUser->id && $authUser->role === 'admin') {
            return false;
        }

        return $authUser->role === 'admin';
    }
}
