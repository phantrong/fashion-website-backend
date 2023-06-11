<?php

namespace App\Repositories\HistorySearchKeyWord;

interface HistorySearchKeyWordRepositoryInterface
{
    /**
     * getListByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getListByUserId($userId, $customerId = null);
}
