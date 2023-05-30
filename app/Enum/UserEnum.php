<?php

namespace App\Enum;

class UserEnum
{
    const TABLE = 'users';

    const STATUS_NEW = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BLOCK = 3;
    const STATUS = [
        self::STATUS_NEW,
        self::STATUS_ACTIVE,
        self::STATUS_BLOCK,
    ];

    const COLUMNS_SELECT = [
        'id',
        'first_name',
        'last_name',
        'avatar',
        'birthday',
        'status',
        'notifications_email',
        'google_id'
    ];
}
