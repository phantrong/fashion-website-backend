<?php

namespace App\Services\Business\HistorySearchKeyWord;

interface HistorySearchKeyWordServiceInterface
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
