<?php

namespace App\Services\Business\RoomHouseware;

use Illuminate\Database\Eloquent\Model;

interface RoomHousewareServiceInterface
{
    /**
     * deleteByRoomId
     *
     * @param  int $roomId
     * @return void
     */
    public function deleteByRoomId($roomId);
}
