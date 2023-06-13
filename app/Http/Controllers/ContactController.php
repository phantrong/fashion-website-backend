<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    private $perpage = 10;

    public function sendByUser(SendContactRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'content',
                'type',
            ]);

            $contact = Business::getContact()->create($data);

            return $this->response()->success($contact);
        } catch (\Exception $exception) {
            Log::error(['sendByUser Contact']);
            throw $exception;
        }
    }

    public function getList(Request $request)
    {
        try {
            $conditions = [
                'per_page' => $request->per_page ?? $this->perpage,
                'page' => $request->page ?? 1
            ];
            if ($request->key_word) {
                $conditions['key_word'] = $request->key_word;
            }
            $contacts = Business::getContact()->getListByAdmin($conditions);
            return $this->response()->success($contacts);
        } catch (\Exception $exception) {
            Log::error(['getList Contact']);
            throw $exception;
        }
    }

    public function getDetail($id)
    {
        try {
            $contact = Business::getContact()->find($id);

            if (!$contact) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            return $this->response()->success($contact);
        } catch (\Exception $exception) {
            Log::error(['getDetail Contact']);
            throw $exception;
        }
    }

    public function delete($id)
    {
        try {
            $contact = Business::getContact()->find($id);

            if (!$contact) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $contact->delete();

            return $this->response()->success();
        } catch (\Exception $exception) {
            Log::error(['delete Contact']);
            throw $exception;
        }
    }
}
