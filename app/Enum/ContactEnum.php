<?php

namespace App\Enum;

class ContactEnum
{
    const TABLE = 'contacts';

    const COLUMNS_SELECT = [
        'name',
        'email',
        'content',
        'type',
        'is_sent_mail',
        'created_at',
    ];

    const COMMENT_TYPE = 1;
    const COOPERATION_CONTACT_TYPE = 2;

    const ARRAY_TYPE = [
        self::COMMENT_TYPE,
        self::COOPERATION_CONTACT_TYPE,
    ];
}
