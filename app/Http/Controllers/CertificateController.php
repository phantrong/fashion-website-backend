<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateListRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;

class CertificateController extends Controller
{
    /**
     * Get the list of certificates.
     *
     * @param CertificateListRequest $request
     * @return JsonResponse
     */
    public function list(CertificateListRequest $request)
    {
        $input = $request->only([
            'per_page',
            'page',
        ]);
        $certificates = Business::getCertificate()->getList($input);

        return $this->response()->success($certificates);
    }
}
