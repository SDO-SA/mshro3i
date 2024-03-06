<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\User;
use App\States\StudentStates;

class GroupPolicy
{
    public function canCreateNewGroup(User $user): bool
    {
        return $user->hasRole(RolesList::ROLE_STUDENT) && $user->state === StudentStates::NotJoined()->value;;
    }

    public function viewCreateGroup(User $user): bool
    {
        return $user->hasRole(RolesList::ROLE_STUDENT) && $user->state === StudentStates::NotJoined()->value;
    }
}
