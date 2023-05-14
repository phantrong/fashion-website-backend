<?php

namespace App\Http\Requests;

use App\Enum\CommonEnum;
use App\Services\Service;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        if (config('services.validation_response_type') == CommonEnum::VALIDATION_RESPONSE_TYPE_MESSAGE) {
            $errors = $validator->errors()->messages();
            foreach ($errors as $attribute => $error) {
                $errors[$attribute] = $error[0];
            }
        } else {
            $errors = $validator->failed();
        }

        throw new HttpResponseException(
            Service::response()->error($errors, Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
