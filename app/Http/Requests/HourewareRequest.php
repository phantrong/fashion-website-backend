<?php

namespace App\Http\Requests;

class HourewareRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id ?? 'NULL';

        return [
            'name' => "required|max:255|unique:housewares,name,$id,id,deleted_at,NULL",
        ];
    }
}
