<?php

namespace App\Repositories\RoomMedia;

interface RoomMediaRepositoryInterface
{
    /**
     * deleteByRoomId
     *
     * @param  int $roomId
     * @return void
     */
    public function deleteByRoomId($roomId);
}
