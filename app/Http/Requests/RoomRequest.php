<?php

namespace App\Http\Requests;

use App\Enum\RoomMediaEnum;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->id ?? 'NULL';

        return [
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
            'room_type_id' => 'required|exists:room_types,id,deleted_at,null',
            'more_description' => 'nullable|max:10000',
            'status' => 'nullable|in:0,1',
            'room_housewares.*.houseware_id' => 'required|exists:housewares,id,deleted_at,null',
            'room_housewares.*.id' => "nullable|exists:room_housewares,id,room_id,$id",
            'room_medias' => 'required',
            'room_medias.*.id' => "nullable|exists:room_medias,id,room_id,$id",
            'room_medias.*.link' => 'required|max:255',
            'room_medias.*.type' => 'required|in:' . RoomMediaEnum::MEDIA_IMAGE_TYPE . ','
                . RoomMediaEnum::MEDIA_VIDEO_TYPE,
        ];
    }
}
