<?php

namespace Database\Seeders;

use App\Base\PermissionsList;
use App\Base\RolesList;
use Illuminate\Database\Seeder;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    protected string $guardName;

    public function __construct()
    {
        $this->guardName = Guard::getDefaultName(Permission::class);
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->insertPermissions();
        $this->insertRoles();
        $this->mapPermissionsToRoles();
    }

    public function insertPermissions(): void
    {
        Permission::query()->upsert(
            array_map(
                fn ($permission) => [
                    'name' => $permission,
                    'guard_name' => $this->guardName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                PermissionsList::ALL_PERMISSIONS()
            ),
            ['name'],
            ['name', 'guard_name']
        );
    }

    public function insertRoles()
    {
        Role::query()->upsert(
            array_map(
                fn ($role) => $role +
                    [
                        'guard_name' => $this->guardName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                RolesList::AVAILABLE_ROLES
            ),
            ['name'],
            ['guard_name']
        );
    }

    public function mapPermissionsToRoles()
    {
        $all_permissions = Permission::all();
        $all_roles = Role::all();

        foreach (RolesList::ROLES_PERMISSIONS_MAP() as $roleName => $permissions) {
            $role = $all_roles->where('name', $roleName)->first();
            $permissionsIds = $all_permissions->whereIn('name', $permissions)->pluck('id');
            $role->permissions()->sync($permissionsIds);
        }
    }
}
