<?php

namespace App\Repositories\InterestedRoomInfomation;

interface InterestedRoomInfomationRepositoryInterface
{
    /**
     * createOrUpdate
     *
     * @param  array $data
     * @return void
     */
    public function createOrUpdate($data);

    /**
     * getListByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getListByUserId($userId, $customerId = null);
}
