<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\Service;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    /**
     * Upload file.
     *
     * @param FileRequest $request
     * @return JsonResponse
     */
    public function upload(FileRequest $request)
    {
        $urlFile = Service::getFile()->store($request->file);

        return $this->response()->success([
            'url_file' => $urlFile,
        ]);
    }
}
