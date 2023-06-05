<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterDateRequest;
use App\Services\Business;
use Illuminate\Support\Facades\Log;

class HomepageAccessTimeController extends Controller
{
    public function getTotalAccessTimes(FilterDateRequest $request)
    {
        try {
            // access time
            $dataAccess = [
                'address_ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent')
            ];

            Business::getHomepageAccessTime()->addAccessTime($dataAccess);

            $total = Business::getHomepageAccessTime()->getTotalAccessTimes($request->start_date, $request->end_date);

            return $this->response()->success(['total' => $total]);
        } catch (\Exception $exception) {
            Log::error(['getTotalAccessTimes Homepage']);
            throw $exception;
        }
    }
}
