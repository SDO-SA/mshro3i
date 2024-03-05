<?php

namespace App\Policies;

use App\Base\RolesList;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Group $group): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     */
    public function canCreateNewGroup(User $user): bool
    {
        return $user->type === RolesList::ROLE_STUDENT;
    } 
}
