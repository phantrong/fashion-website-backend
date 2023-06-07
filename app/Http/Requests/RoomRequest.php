<?php

namespace App\Http\Requests;

use App\Enum\RoomMediaEnum;

class RoomRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->id ?? 'NULL';

        $rules = [
            'title' => 'required|max:255',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
            'address_detail' => 'nullable|max:1000',
            'maps_location' => 'nullable|max:255',
            'is_negotiate' => 'required|in:0,1',
            'cost' => 'nullable|integer|digits_between:0,18',
            'acreage' => 'required|integer|digits_between:0,18',
            'max_people_allowed' => 'nullable|integer|digits_between:0,3',
            'room_type_id' => 'required|exists:room_types,id,deleted_at,NULL',
            'more_description' => 'nullable|max:10000',
            'status' => 'nullable|in:0,1',
            'room_housewares.*.houseware_id' => 'required|distinct|exists:housewares,id,deleted_at,NULL',
            'room_housewares.*.id' => "nullable|distinct|exists:room_housewares,id,room_id,$id",
            'room_medias' => 'required',
            'room_medias.*.id' => "nullable|distinct|exists:room_medias,id,room_id,$id",
            'room_medias.*.link' => 'required|distinct|max:255',
            'room_medias.*.type' => 'required|in:' . RoomMediaEnum::MEDIA_IMAGE_TYPE . ','
                . RoomMediaEnum::MEDIA_VIDEO_TYPE,
        ];

        if (!$this->is_negotiate) {
            $rules['cost'] = 'required|integer|digits_between:0,18';
        }

        return $rules;
    }
}
