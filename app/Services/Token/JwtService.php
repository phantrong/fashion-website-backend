<?php

namespace App\Services\Token;

use App\Enum\CommonEnum;
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
    public function encode(array $data, $userRole = CommonEnum::USER_ROLE_USER)
    {
        $url = config('app.url');
        $expireTime = config('jwt.expire_time');
        $key = $this->getKeyJwt($userRole);
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
    public function decode($token, $userRole = CommonEnum::USER_ROLE_USER)
    {
        try {
            $key = $this->getKeyJwt($userRole);
            $algorithm = config('jwt.algorithm');

            return JWT::decode($token, new Key($key, $algorithm));
        } catch (Exception $exception) {
            Log::error('[Authenticate]', [
                "{$exception->getMessage()} - {$exception->getFile()} - {$exception->getLine()}",
            ]);
            throw new AuthenticationException();
        }
    }

    public function getUserInfo($token, $userRole = CommonEnum::USER_ROLE_USER)
    {
        try {
            $key = $this->getKeyJwt($userRole);
            $algorithm = config('jwt.algorithm');

            return JWT::decode($token, new Key($key, $algorithm))->sub->dat;
        } catch (Exception $exception) {
            Log::error('[Authenticate]', [
                "{$exception->getMessage()} - {$exception->getFile()} - {$exception->getLine()}",
            ]);
            throw new AuthenticationException();
        }
    }

    /**
     * @param  int $useRole
     * @return string
     */
    private function getKeyJwt($userRole)
    {
        switch ($userRole) {
            case CommonEnum::USER_ROLE_ADMIN:
                $key = config('jwt.admin_key');
                break;
            default:
                $key = config('jwt.key');
                break;
        }
        return $key;
    }
}
