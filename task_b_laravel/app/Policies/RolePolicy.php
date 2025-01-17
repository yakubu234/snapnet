<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageRoles(User $user)
    {
        return $user->roles->contains('name', 'Admin');
    }
}
