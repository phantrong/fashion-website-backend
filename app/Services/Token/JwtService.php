<?php

namespace App\Services\Token;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;

class JwtService implements JwtServiceInterface
{
    /**
     * Encode token.
     *
     * @param array $data
     * @return string
     */
    public function encode(array $data)
    {
        $url = config('app.url');
        $expireTime = config('jwt.expire_time');
        $key = config('jwt.key');
        $algorithm = config('jwt.algorithm');

        $payload = [
            'iss' => $url,
            'iat' => time(),
            'exp' => time() + $expireTime,
            'sub' => [
                'dat' => $data,
            ],
        ];

        return JWT::encode($payload, $key, $algorithm);
    }

    /**
     * Decode token.
     *
     * @param $token
     * @return mixed
     * @throws Exception
     */
    public function decode($token)
    {
        try {
            $key = config('jwt.key');
            $algorithm = config('jwt.algorithm');

            return JWT::decode($token, new Key($key, $algorithm));
        } catch (Exception $exception) {
            Log::error('[Authenticate]', [
                "{$exception->getMessage()} - {$exception->getFile()} - {$exception->getLine()}",
            ]);
            throw new AuthenticationException();
        }
    }
}
