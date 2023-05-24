<?php

namespace App\Http\Requests;

class FileMediaRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:jpg,jpeg,png,mp4,mov,webm|max:10240',
        ];
    }
}
