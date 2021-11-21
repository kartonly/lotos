<?php


namespace App;


use App\Models\Permission;
use App\Models\User;

class PermissionManager
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function giveUserPermissions()
    {
        $this->givePermissionsByModule(Permission::USER_MODULE, $this->user->id);
    }

    public function giveAdminPermissions()
    {
        $this->givePermissionsByModule(Permission::USER_MODULE, $this->user->id);
        $this->givePermissionsByModule(Permission::ROOMS_MODULE, $this->user->id);
    }

    public function givePermissionsByModule($module, $id = null)
    {
        $id = ($id) ? ".{$id}" : "";

        Permission::findOrCreate("{$module}.view" . $id);
        Permission::findOrCreate("{$module}.update" . $id);
        Permission::findOrCreate("{$module}.delete" . $id);

        $this->user->givePermissionTo(
            "{$module}.view" . $id,
            "{$module}.update" . $id,
            "{$module}.delete" . $id
        );
    }

    public function revokePermissionsByModule($module, $id = null)
    {
        $id = ($id) ? ".{$id}" : "";

        if (Permission::where('name', "{$module}.view" . $id)->first()) {
            $this->user->revokePermissionTo("{$module}.view" . $id);
        }

        if (Permission::where('name', "{$module}.update" . $id)->first()) {
            $this->user->revokePermissionTo("{$module}.update" . $id);
        }

        if (Permission::where('name', "{$module}.delete" . $id)->first()) {
            $this->user->revokePermissionTo("{$module}.delete" . $id);
        }
    }
}
