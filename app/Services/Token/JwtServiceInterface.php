<?php

namespace App\Services\Token;

use Exception;

interface JwtServiceInterface
{
    /**
     * Encode token.
     *
     * @param array $data
     * @return string
     */
    public function encode(array $data);

    /**
     * Decode token.
     *
     * @param $token
     * @return mixed
     *
     * @throws Exception
     */
    public function decode($token);
}
