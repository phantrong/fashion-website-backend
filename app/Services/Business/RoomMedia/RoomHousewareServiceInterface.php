<?php

namespace App\Services\Business\RoomMedia;

use Illuminate\Database\Eloquent\Model;

interface RoomMediaServiceInterface
{
    /**
     * deleteByRoomId
     *
     * @param  int $roomId
     * @return void
     */
    public function deleteByRoomId($roomId);
}
