<?php

namespace App\Repositories\RoomType;

use App\Models\RoomType;
use App\Repositories\Base\BaseRepository;

class RoomTypeRepository extends BaseRepository implements RoomTypeRepositoryInterface
{
    /**
     * RoomTypeRepository constructor.
     *
     * @param RoomType $roomType
     */
    public function __construct(RoomType $roomType)
    {
        parent::__construct($roomType);
    }
}
