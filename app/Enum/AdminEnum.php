<?php

namespace App\Enum;

class AdminEnum
{
    const TABLE = 'admins';

    const COLUMNS_SELECT = [
        'id',
        'name',
        'type',
        'email',
        'password',
        'status',
        'create_admin',
        'update_admin',
    ];

    const TYPE_ROOT_ADMIN = 1;

    const STATUS_NEW = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BLOCK = 3;
}
