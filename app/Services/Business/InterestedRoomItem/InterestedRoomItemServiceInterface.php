<?php

namespace App\Services\Business\InterestedRoomItem;

interface InterestedRoomItemServiceInterface
{
    /**
     * addItem
     *
     * @param  array $data
     * @return void
     */
    public function addItem($data);


    /**
     * getListItemByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getListItemByUserId($userId, $customerId = null);

    /**
     * getListDetailItemByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @param  array $condition
     * @return object
     */
    public function getListDetailItemByUserId($userId, $customerId = null, $condition = []);
}
