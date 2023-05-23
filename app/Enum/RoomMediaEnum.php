<?php

namespace App\Enum;

class RoomMediaEnum
{
    const TABLE = 'room_medias';

    const COLUMNS_SELECT = [
        'id',
        'room_id',
        'link',
        'type'
    ];

    const MEDIA_IMAGE_TYPE = 1;
    const MEDIA_VIDEO_TYPE = 2;
}
