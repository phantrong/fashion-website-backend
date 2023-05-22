<?php

namespace App\Services\Token;

use Exception;

interface JwtServiceInterface
{
    /**
     * Encode token.
     *
     * @param array $data
     * @param  int $userRole
     * @return string
     */
    public function encode(array $data, $userRole);

    /**
     * Decode token.
     *
     * @param $token
     * @param  int $userRole
     * @return mixed
     *
     * @throws Exception
     */
    public function decode($token, $userRole);

    /**
     * getUserInfo
     *
     * @param  mixed $token
     * @param  int $userRole
     * @return object
     * 
     * @throws Exception
     */
    public function getUserInfo($token, $userRole);
}
