<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Business;
use App\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!Auth::attempt($input)) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        $accessToken = Business::getUser()->createToken(Arr::only($input , [
            'email',
        ]));

        return $this->response()->success([
            'token' => $accessToken,
        ]);
    }

    /**
     * Logout.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        Business::getUser()->destroyToken($request->bearerToken());

        return $this->response()->success();
    }
}
