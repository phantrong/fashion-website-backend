<?php

namespace App\Http\Requests;

use App\Enum\ContactEnum;
use Illuminate\Foundation\Http\FormRequest;

class SendContactRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $types =  implode(',', ContactEnum::ARRAY_TYPE);

        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,filter',
            'content' => 'required|max:1000',
            'type' => "required|in:$types",
        ];
    }
}
