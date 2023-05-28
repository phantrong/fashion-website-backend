<?php

namespace App\Http\Controllers;

use App\Enum\AdminEnum;
use App\Http\Requests\LoginRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function loginUser(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!Auth::attempt($input)) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        if (!$user || $user->status == AdminEnum::STATUS_NEW) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        if ($user->status == AdminEnum::STATUS_BLOCK) {
            return $this->response()->errorCode(__('message.user.blocked'), JsonResponse::HTTP_NOT_ACCEPTABLE);
        }
        $dataToken = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'birthday' => $user->birthday,
            'notifications_email' => $user->notifications_email,
            'status' => $user->status
        ];

        $accessToken = Business::getUser()->createToken($dataToken);

        return $this->response()->success([
            'token' => $accessToken,
            'user' => $dataToken
        ]);
    }

    /**
     * Logout for user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutUser(Request $request)
    {
        Business::getUser()->destroyToken($request->bearerToken());

        return $this->response()->success();
    }

    /**
     * Login.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function loginAdmin(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!Auth::guard('admin')->attempt($input)) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        $admin = Auth::guard('admin')->user();
        if (!$admin || $admin->status == AdminEnum::STATUS_NEW) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        if ($admin->status == AdminEnum::STATUS_BLOCK) {
            return $this->response()->error(__('message.error.406'), JsonResponse::HTTP_NOT_ACCEPTABLE);
        }
        $dataToken = [
            'id' => $admin->id,
            'name' => $admin->name,
            'type' => $admin->type,
            'status' => $admin->status
        ];

        $accessToken = Business::getAdmin()->createToken($dataToken);

        return $this->response()->success([
            'token' => $accessToken,
            'admin' => $dataToken
        ]);
    }

    /**
     * Logout for Admin
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutAdmin(Request $request)
    {
        Business::getAdmin()->destroyToken($request->bearerToken());

        return $this->response()->success();
    }
}
