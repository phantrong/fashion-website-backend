<?php

namespace App\Http\Requests;

class UpdateUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => 'nullable|max:255',
            'first_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'birthday' => 'nullable|date_format:Y-m-d|before:' . getNow()->subYears(10)->format('Y-m-d'),
            'notifications_email' => 'required|in:0,1'
        ];
    }
}
