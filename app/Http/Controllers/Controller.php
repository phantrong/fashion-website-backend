<?php

namespace App\Http\Controllers;

use App\Services\Service;
use App\Services\Api\ResponseFactoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get ResponseFactory.
     *
     * @return ResponseFactoryInterface
     */
    public function response()
    {
        return Service::response();
    }

    public function getUserRole($request)
    {
        return $request->header('user_role');
    }

    /**
     *
     * @param  Request $request
     * @return object
     */
    public function getAuth($request)
    {
        $token = $request->bearerToken();
        return Service::getJWT()->getUserInfo($token, $this->getUserRole($request));
    }
}
