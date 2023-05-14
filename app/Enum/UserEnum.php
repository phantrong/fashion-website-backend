<?php

namespace App\Enum;

class UserEnum
{
    const TABLE = 'users';

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];

    const COLUMNS_SELECT = [
        'id',
        'avatar',
        'name',
        'gender',
        'birthday',
        'email',
    ];
}
