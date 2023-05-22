<?php

namespace App\Services\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * Make the success response.
     *
     * @param $data
     * @param string $message
     * @param int $status
     * @return ResponseFactory|JsonResponse
     */
    public function success($data = null, string $message = 'Success', int $status = JsonResponse::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }

        return $this->make($response, $status);
    }

    /**
     * Make the error response.
     *
     * @param $message
     * @param int $status
     * @return ResponseFactory|Response
     */
    public function error($message, int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
    {
        return $this->make([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    /**
     * Make the error response.
     *
     * @param $message
     * @param int $status
     * @param array $data
     * @return ResponseFactory|Response
     */
    public function errorCode($code, int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $data = [])
    {

        $response = [
            'success' => false,
            'code' => $code,
        ];
        if ($data) {
            $response['data'] = $data;
        }

        return $this->make($response, $status);
    }

    /**
     * Make the response.
     *
     * @param mixed $data
     * @param int $status
     *
     * @return ResponseFactory|Response
     */
    private function make($data, int $status)
    {
        return response($data, $status);
    }
}
