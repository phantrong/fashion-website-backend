<?php

namespace App\Repositories\InterestedRoom;

use App\Models\InterestedRoom;
use App\Repositories\Base\BaseRepository;

class InterestedRoomRepository extends BaseRepository implements InterestedRoomRepositoryInterface
{
    /**
     * InterestedRoomRepository constructor.
     *
     * @param InterestedRoom $interestedRoom
     */
    public function __construct(InterestedRoom $interestedRoom)
    {
        parent::__construct($interestedRoom);
    }

    public function getInterestedRoomsByUserId($userId, $customerId = null)
    {
        return $this->model
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($customerId, function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->orderByDesc('created_at')
            ->first();
    }
}
