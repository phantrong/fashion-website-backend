<?php

namespace App\Enum;

class CommonEnum
{
    const DEFAULT_PER_PAGE = 10;
    const DEFAULT_PAGE = 1;

    const FOLDER_TEMP = 'temp';
    const FOLDER_USER = 'user';

    const VALIDATION_RESPONSE_TYPE_KEY = 'key';
    const VALIDATION_RESPONSE_TYPE_MESSAGE = 'message';
    const VALIDATION_RESPONSE_TYPE = [
        self::VALIDATION_RESPONSE_TYPE_KEY,
        self::VALIDATION_RESPONSE_TYPE_MESSAGE,
    ];

    const MASKED_KEY = [
        'password',
    ];

    const USER_ROLE_ADMIN = 1;
    const USER_ROLE_USER = 2;
}
