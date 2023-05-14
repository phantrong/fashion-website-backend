<?php

namespace App\Http\Requests;

use App\Enum\UserEnum;

class UserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $gendersStr = implode(',', UserEnum::GENDER);
        $tableUser = UserEnum::TABLE;

        return [
            'avatar' => 'nullable|url',
            'name' => 'required|max:60',
            'gender' => "required|in:$gendersStr",
            'birthday' => 'required|date_format:"Y-m-d"',
            'email' => "required|max:255|email:rfc,dns|unique:$tableUser,email,$this->id,id,deleted_at,NULL",
        ];
    }
}
