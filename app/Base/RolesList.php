<?php

namespace App\Base;

class RolesList
{
    const ROLE_ADMIN = 'admin';

    const ROLE_STUDENT = 'student';

    const ROLE_SUPERVISOR = 'supervisor';

    const ROLE_GPC = 'gpc';

    const AVAILABLE_ROLES = [
        ['name' => self::ROLE_ADMIN],
        ['name' => self::ROLE_STUDENT],
        ['name' => self::ROLE_SUPERVISOR],
        ['name' => self::ROLE_GPC],
    ];

    const STUDENT_PERMISSIONS = [
        PermissionsList::STUDENT,
        PermissionsList::GROUP_LIST,
        PermissionsList::GROUP_CREATE,
        PermissionsList::GROUP_SHOW,
        PermissionsList::PROJECT_CREATE,
        PermissionsList::PROJECT_UPDATE,
        PermissionsList::PROJECT_SHOW,
    ];

    const SUPERVISOR_PERMISSIONS = [
        PermissionsList::SUPERVISOR,
        PermissionsList::GROUP_LIST,
        PermissionsList::GROUP_SHOW,
        PermissionsList::PROJECT_SHOW,
        PermissionsList::PROJECT_LIST,
    ];

    public static function ROLES_PERMISSIONS_MAP()
    {
        return [
            self::ROLE_ADMIN => PermissionsList::ADMIN_PERMISSIONS(),
            self::ROLE_STUDENT => self::STUDENT_PERMISSIONS,
            self::ROLE_SUPERVISOR => self::SUPERVISOR_PERMISSIONS,
        ];
    }
}
