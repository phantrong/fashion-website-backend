<?php

namespace App\Services\Api;

use Illuminate\Http\JsonResponse;

interface ResponseFactoryInterface
{
    /**
     * Make the success response.
     *
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function success($data = null, string $message = 'Success', int $status = JsonResponse::HTTP_OK);

    /**
     * Make the error response.
     *
     * @param $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error($message, int $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR);

    /**
     * Make the error response.
     *
     * @param $code
     * @param int $statusCode
     * @param array $data
     * @return JsonResponse
     */
    public function errorCode($code, int $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $data = []);
}
