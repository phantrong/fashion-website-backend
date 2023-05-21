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
}
