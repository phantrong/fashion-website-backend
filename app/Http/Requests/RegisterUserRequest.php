<?php

namespace App\Http\Requests;

use App\Enum\UserEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'birthday' => 'required|date_format:Y-m-d|before:' . getNow()->subYears(10)->format('Y-m-d'),
            'email' => [
                "required",
                "email:rfc,filter",
                "max:255",
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('status', '!=', UserEnum::STATUS_NEW)
                        ->whereNull('deleted_at');
                })
            ],
            'password' => 'required|min:8|max:255',
            'password_confirm' => 'required|same:password'
        ];
    }
}
