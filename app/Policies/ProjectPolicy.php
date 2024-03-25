<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\Project;
use App\Models\User;
use App\States\StudentStates;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function canCreateProjectProposal(User $user): bool
    {
        $isStudent = $user->hasRole(RolesList::ROLE_STUDENT);
        $isGroupLeader = $user->state === StudentStates::GroupLeader()->value;

        return $isStudent && $isGroupLeader && ! Project::where('group_id', $user->group_id)->exists();
    }

    public function canSeeProjectInfo(User $user): bool
    {
        $isStudent = $user->hasRole(RolesList::ROLE_STUDENT);
        $isGroupLeader = $user->state === StudentStates::GroupLeader()->value;
        $isGroupMember = $user->state === StudentStates::GroupMember()->value;

        return $isStudent && ($isGroupLeader || $isGroupMember);
    }
}
