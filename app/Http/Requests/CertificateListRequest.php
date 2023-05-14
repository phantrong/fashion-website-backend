<?php

namespace App\Http\Requests;

class CertificateListRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => 'numeric|min:1',
            'page' => 'numeric|min:1',
        ];
    }
}
