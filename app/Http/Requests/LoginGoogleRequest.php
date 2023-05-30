<?php

namespace App\Http\Requests;

class LoginGoogleRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255|email:rfc,filter',
            'sub' => 'required|regex:/^\d{21}$/',
            'given_name' => 'nullable|max:255',
            'family_name' => 'required|max:255',
            'picture' => 'required|regex:/^https?:\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'
        ];
    }
}
