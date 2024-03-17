<?php

namespace App\Base;

use ReflectionClass;

class PermissionsList
{
    const STUDENT = 'student';

    const SUPERVISOR = 'supervisor';

    const GPC = 'gpc';

    const ADMIN = 'admin';

    const GROUP_LIST = 'group.list';

    const GROUP_SHOW = 'group.show';

    const GROUP_CREATE = 'group.create';

    const GROUP_UPDATE = 'group.update';

    const GROUP_DELETE = 'group.delete';

    const PROJECT_LIST = 'project.list';

    const PROJECT_SHOW = 'project.show';

    const PROJECT_CREATE = 'project.create';

    const PROJECT_UPDATE = 'project.update';

    const PROJECT_DELETE = 'project.delete';

    const GROUP_GROUP = [
        self::GROUP_LIST,
        self::GROUP_SHOW,
        self::GROUP_CREATE,
        self::GROUP_UPDATE,
        self::GROUP_DELETE,
    ];

    const PROJECT_GROUP = [
        self::PROJECT_LIST,
        self::PROJECT_SHOW,
        self::PROJECT_CREATE,
        self::PROJECT_UPDATE,
        self::PROJECT_DELETE,
    ];

    public static function ADMIN_PERMISSIONS(): array
    {
        // Admin's Excluded permissions
        $ADMIN_EXCLUDED_PERMISSIONS = [
            self::STUDENT,
            self::SUPERVISOR,
            self::GPC,
        ];

        return array_filter(
            self::ALL_PERMISSIONS(),
            function ($permission) use ($ADMIN_EXCLUDED_PERMISSIONS) {
                return ! in_array($permission, $ADMIN_EXCLUDED_PERMISSIONS);
            }
        );
    }

    public static function ALL_PERMISSIONS(): array
    {
        return collect((array_values((new ReflectionClass(__CLASS__))->getConstants())))
            ->filter(function ($constant) {
                return ! is_array($constant);
            })->toArray();
    }
}
