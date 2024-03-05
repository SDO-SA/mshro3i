<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\User;

class GroupPolicy
{
    public function canCreateNewGroup(User $user): bool
    {
        return $user->type === RolesList::ROLE_STUDENT;
    }

    public function viewCreateGroup(User $user): bool
    {
        return $user->type === RolesList::ROLE_STUDENT;
    }
}
