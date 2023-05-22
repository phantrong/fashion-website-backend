<?php

namespace App\Http\Middleware;

use App\Enum\AdminEnum;
use App\Enum\CommonEnum;
use App\Services\Business;
use App\Services\Service;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Adminer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $auth = Service::getJWT()->getUserInfo($token, CommonEnum::USER_ROLE_ADMIN);
        $adminCurrent = Business::getAdmin()->getDetail(@$auth->id);

        if (!$adminCurrent || $adminCurrent->status != AdminEnum::STATUS_ACTIVE) {
            return Service::response()->error(__('message.error.403'), JsonResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
