<?php

namespace App\Repositories\RoomHouseware;

interface RoomHousewareRepositoryInterface
{
    /**
     * deleteByRoomId
     *
     * @param  int $roomId
     * @return void
     */
    public function deleteByRoomId($roomId);
}
