<?php

namespace App\Repositories\InterestedRoomInfomation;

use App\Models\InterestedRoomInfomation;
use App\Repositories\Base\BaseRepository;

class InterestedRoomInfomationRepository extends BaseRepository implements InterestedRoomInfomationRepositoryInterface
{
    /**
     * InterestedRoomInfomationRepository constructor.
     *
     * @param InterestedRoomInfomation $interestedRoomInfomation
     */
    public function __construct(InterestedRoomInfomation $interestedRoomInfomation)
    {
        parent::__construct($interestedRoomInfomation);
    }
}
