<?php

namespace App\Services\Business\InterestedRoom;

interface InterestedRoomServiceInterface
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
