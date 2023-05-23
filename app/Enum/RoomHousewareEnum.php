<?php

namespace App\Enum;

class RoomHousewareEnum
{
    const TABLE = 'room_housewares';

    const COLUMNS_SELECT = [
        'id',
        'room_id',
        'houseware_id'
    ];
}
