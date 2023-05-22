<?php

namespace App\Http\Controllers;

use App\Http\Requests\HourewareRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HousewareController extends Controller
{
    private $perpage = 10;

    public function getList(Request $request)
    {
        try {
            $conditions = [
                'per_page' => $request->per_page ?? $this->perpage,
                'page' => $request->page ?? 1
            ];
            $housewares = Business::getHouseware()->getList($conditions);
            return $this->response()->success($housewares);
        } catch (\Exception $exception) {
            Log::error(['getList Houseware']);
            throw $exception;
        }
    }

    public function getDetail($id)
    {
        try {
            $houseware = Business::getHouseware()->find($id);

            if (!$houseware) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            return $this->response()->success($houseware);
        } catch (\Exception $exception) {
            Log::error(['getDetail Houseware']);
            throw $exception;
        }
    }

    public function create(HourewareRequest $request)
    {
        try {
            $data = $request->only(['name']);

            $houseware = Business::getHouseware()->create($data);

            return $this->response()->success($houseware);
        } catch (\Exception $exception) {
            Log::error(['create Houseware']);
            throw $exception;
        }
    }

    public function update(HourewareRequest $request, $id)
    {
        try {
            $data = $request->only(['name']);

            $houseware = Business::getHouseware()->find($id);

            if (!$houseware) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $houseware->update($data);

            return $this->response()->success($houseware);
        } catch (\Exception $exception) {
            Log::error(['update Houseware']);
            throw $exception;
        }
    }

    public function delete($id)
    {
        try {
            $houseware = Business::getHouseware()->find($id);

            if (!$houseware) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $houseware->delete();

            return $this->response()->success();
        } catch (\Exception $exception) {
            Log::error(['delete Houseware']);
            throw $exception;
        }
    }
}
