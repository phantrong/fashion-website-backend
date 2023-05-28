<?php

namespace App\Http\Controllers;

use App\Services\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function getListProvince(Request $request)
    {
        try {
            $provinces = Business::getProvince()->getList();
            return $this->response()->success($provinces);
        } catch (\Exception $exception) {
            Log::error(['getListProvince']);
            throw $exception;
        }
    }

    public function getListDistrict(Request $request)
    {
        try {
            $conditions = [];
            if ($request->province_id) {
                $conditions['province_id'] = $request->province_id;
            }
            $districts = Business::getDistrict()->getList($conditions);
            return $this->response()->success($districts);
        } catch (\Exception $exception) {
            Log::error(['getListDistrict']);
            throw $exception;
        }
    }

    public function getListWard(Request $request)
    {
        try {
            $conditions = [];
            if ($request->district_id) {
                $conditions['district_id'] = $request->district_id;
            }
            $wards = Business::getWard()->getList($conditions);
            return $this->response()->success($wards);
        } catch (\Exception $exception) {
            Log::error(['getListWard']);
            throw $exception;
        }
    }
}
