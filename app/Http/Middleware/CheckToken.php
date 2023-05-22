<?php

namespace App\Http\Middleware;

use App\Repositories\Repository;
use App\Services\Service;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckToken
{
    /**
     * Check user activation.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = $request->header('user_role');
        $token = $request->bearerToken();
        if (!$token) {
            return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }

        $invalidToken = Repository::getInvalidToken()->exists([
            'token' => $token,
        ]);
        if (!$invalidToken) {
            $payload = Service::getJWT()->decode($token, $userRole);
            if ($payload && $payload->exp >= time()) {
                return $next($request);
            }
        }

        return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
    }
}
