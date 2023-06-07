<?php

namespace App\Repositories\InterestedRoom;

interface InterestedRoomRepositoryInterface
{
    /**
     * getInterestedRoomsByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getInterestedRoomsByUserId($userId, $customerId = null);
}
