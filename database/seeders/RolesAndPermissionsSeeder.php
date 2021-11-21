<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $usersPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'users']),
            'update' => Permission::firstOrCreate(['name' => 'users.update']),
            'delete' => Permission::firstOrCreate(['name' => 'users.delete']),
            'view' => Permission::firstOrCreate(['name' => 'users.view']),
        ];

        $permissionsPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'permissions']),
            'update' => Permission::firstOrCreate(['name' => 'permissions.update']),
            'delete' => Permission::firstOrCreate(['name' => 'permissions.delete']),
            'view' => Permission::firstOrCreate(['name' => 'permissions.view']),
        ];

        $roomsPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'rooms']),
            'create' => Permission::firstOrCreate(['name' => 'rooms.create']),
            'update' => Permission::firstOrCreate(['name' => 'rooms.update']),
            'delete' => Permission::firstOrCreate(['name' => 'rooms.delete']),
            'view' => Permission::firstOrCreate(['name' => 'rooms.view']),
        ];


        $userRole = Role::firstOrCreate(['name' => \App\Models\Role::USER_ROLE]);
        $userRole->givePermissionTo(
            $usersPermissions['view'],
            $usersPermissions['update'],
        );

        $adminRole = Role::firstOrCreate(['name' => \App\Models\Role::ADMIN_ROLE]);
        $adminRole->givePermissionTo(
            $usersPermissions['all'],
            $permissionsPermissions['all'],
            $roomsPermissions['all'],
        );

    }
}
