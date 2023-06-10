<?php

namespace App\Repositories\RoomViewTime;

interface RoomViewTimeRepositoryInterface
{
    /**
     * addViewTime
     *
     * @param  array $data
     * @return void
     */
    public function addViewTime(array $data);

    /**
     * getTotalViewTimesByRoomId
     *
     * @param  int $roomId
     * @param  string $startTime
     * @param  string $endTime
     * @return int
     */
    public function getTotalViewTimesByRoomId(int $roomId, string $startTime = null, string $endTime = null);
    
    /**
     * getHistoryArrayRoomIdsByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return array
     */
    public function getHistoryArrayRoomIdsByUserId($userId, $customerId = null);
}
