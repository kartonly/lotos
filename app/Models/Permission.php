<?php


namespace App\Models;

use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    public const USER_MODULE = 'users';
    public const ROOMS_MODULE = 'rooms';

    public $guard_name = 'api';
}
