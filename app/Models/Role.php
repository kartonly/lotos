<?php


namespace App\Models;

use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    public const USER_ROLE = 'user';
    public const ADMIN_ROLE = 'admin';

    public const ROLES = [
        self::USER_ROLE,
        self::ADMIN_ROLE,
    ];

    public $guard_name = 'api';
}
