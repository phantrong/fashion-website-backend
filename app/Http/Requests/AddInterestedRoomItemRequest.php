<?php

namespace App\Http\Requests;

use App\Enum\RoomEnum;

class AddInterestedRoomItemRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $statusShow = RoomEnum::STATUS_SHOW;

        return [
            'room_id' => "required|exists:rooms,id,deleted_at,NULL,status,$statusShow",
        ];
    }
}
