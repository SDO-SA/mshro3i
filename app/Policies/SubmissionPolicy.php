<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\User;
use App\States\StudentStates;

class SubmissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function canSubmitAssignment(User $user): bool
    {
        return $user->hasRole(RolesList::ROLE_STUDENT) && $user->state === StudentStates::GroupLeader()->value;
    }
}
