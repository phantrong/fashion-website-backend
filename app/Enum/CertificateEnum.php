<?php

namespace App\Enum;

class CertificateEnum
{
    const TABLE_CERTIFICATE = 'certificates';
    const TABLE_USER_CERTIFICATE = 'user_certificate';

    const COLUMNS_SELECT = [
        'id',
        'name',
        'invalid_year',
    ];
}
