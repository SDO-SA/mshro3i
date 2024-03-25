<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\User;
use App\States\StudentStates;
use App\Models\Project;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function canCreateProjectProposal(User $user): bool
    {
        return $user->hasRole(RolesList::ROLE_STUDENT) && $user->state === StudentStates::GroupLeader()->value && ! Project::where('group_id', $user->group_id)->exists();
    }
}
