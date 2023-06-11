<?php

namespace App\Services\Business\InterestedRoomInfomation;

interface InterestedRoomInfomationServiceInterface
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
