<?php

namespace App\Enum;

class RoomEnum
{
    const TABLE = 'rooms';

    const COLUMNS_SELECT = [
        'id',
        'title',
        'province_id',
        'district_id',
        'ward_id',
        'address_detail',
        'maps_location',
        'is_negotiate',
        'cost',
        'acreage',
        'max_people_allowed',
        'room_type_id',
        'more_description',
        'status',
    ];

    const MAX_NUMBER_VIDEO_AND_IMAGE = 10;

    const STATUS_HIDDEN = 0;
    const STATUS_SHOW = 1;

    const GSO_ID_HA_NOI = 1;
    const HA_NOI_CITY = 'Thành phố Hà Nội';
}
