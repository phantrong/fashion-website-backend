<?php

namespace App\Http\Controllers;

use App\Enum\LogEnum;
use App\Enum\VerifyEnum;
use App\Jobs\SendMailVerifyEmail;
use App\Services\Service;
use App\Services\Api\ResponseFactoryInterface;
use App\Services\Business;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        if (!$token) return null;
        return Service::getJWT()->getUserInfo($token, $this->getUserRole($request));
    }

    /**
     *
     * @param  string $email
     * @param  Model $user
     * @param  string|null  $agencyCompanyName
     * @param  int $type
     * @return Model
     */
    public function sendEmailUserVerifyEmail($user, $type)
    {
        $codeVerify = base64_encode(uniqid() . strtotime(getNow()->toTimeString()) . '_' . $user->id);
        $sendLastTime = base64_encode(getNow()->format('Y-m-d H:i:s'));
        $dataVerify = [
            'email_phone' => $user->email,
            'code_verify' => $codeVerify,
            'type' => $type,
            'user_role' => $user->user_role
        ];
        $verify = Business::getVerify()->createOrUpdate($dataVerify);

        if ($type == VerifyEnum::TYPE_REGISTER_SETTING_PWD) {
            $link = getLinkFrontend($user->user_role)
                . '/verify-email?code='
                . $dataVerify['code_verify'];
        } else {
            $link = getLinkFrontend($user->user_role)
                . '/setting-password?type='
                . $type
                . '&code='
                . $dataVerify['code_verify']
                . "&time=$sendLastTime";
        }

        $dataEmail =  [
            'link' => $link,
            'user' => $user,
            'type' => $type
        ];

        log_dispatch_email($dataVerify['email_phone'], LogEnum::LOG_EMAIL_VERIFY, [
            'link' => $link,
            'type' => $type,
        ]);

        SendMailVerifyEmail::dispatch($dataVerify['email_phone'], $dataEmail)->onQueue(LogEnum::QUEUE_EMAIL);
        return $verify;
    }

    public function getCustomerIdOrUserId(Request $request)
    {
        $data = [
            'customer_id' => null,
            'user_id' => null,
        ];
        $user = $this->getAuth($request);
        if (!$user) {
            $customerId = $request->header('customer_id');
            if (!$customerId) {
                return false;
            }
            $data['customer_id'] = $customerId;
        } else {
            $data['user_id'] = $user->id;
        }
        return $data;
    }
}
