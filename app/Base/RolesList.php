<?php

namespace App\Base;

class RolesList
{
    const ROLE_ADMIN = 'admin';

    const ROLE_STUDENT = 'student';

    const ROLE_GROUP_LEADER = 'group_leader';

    const ROLE_GROUP_MEMBER = 'group_member';

    const ROLE_SUPERVISOR = 'supervisor';

    const ROLE_GPC = 'gpc';

    const AVAILABLE_ROLES = [
        ['name' => self::ROLE_ADMIN],
        ['name' => self::ROLE_STUDENT],
        ['name' => self::ROLE_GROUP_LEADER],
        ['name' => self::ROLE_GROUP_MEMBER],
        ['name' => self::ROLE_SUPERVISOR],
        ['name' => self::ROLE_GPC],
    ];
}
