<?php

namespace App\Repositories\RoomHouseware;

use App\Models\RoomHouseware;
use App\Repositories\Base\BaseRepository;

class RoomHousewareRepository extends BaseRepository implements RoomHousewareRepositoryInterface
{
    /**
     * RoomHousewareRepository constructor.
     *
     * @param RoomHouseware $roomHouseware
     */
    public function __construct(RoomHouseware $roomHouseware)
    {
        parent::__construct($roomHouseware);
    }

    public function deleteByRoomId($roomId)
    {
        $this->model->where('room_id', $roomId)
            ->delete();
    }
}
