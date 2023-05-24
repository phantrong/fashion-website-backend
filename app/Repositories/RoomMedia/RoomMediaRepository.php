<?php

namespace App\Repositories\RoomMedia;

use App\Models\RoomMedia;
use App\Repositories\Base\BaseRepository;

class RoomMediaRepository extends BaseRepository implements RoomMediaRepositoryInterface
{
    /**
     * RoomMediaRepository constructor.
     *
     * @param RoomMedia $roomMedia
     */
    public function __construct(RoomMedia $roomMedia)
    {
        parent::__construct($roomMedia);
    }

    public function deleteByRoomId($roomId)
    {
        $this->model->where('room_id', $roomId)
            ->delete();
    }
}
