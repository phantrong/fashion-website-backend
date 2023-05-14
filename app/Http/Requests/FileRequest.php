<?php

namespace App\Http\Requests;

use App\Enum\FileEnum;
use App\Services\Service;
use Illuminate\Contracts\Validation\Validator;

class FileRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(',', FileEnum::TYPE_LIST);

        return [
            'file' => 'required|max:20480',
            'type' => "required|in:$types",
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if (!$validator->failed()) {
                $fileExtension = Service::getFile()->getExtension($this->file);
                $fileExtensionList = $this->type == FileEnum::TYPE_ALL ?
                    FileEnum::ALL_EXTENSION_LIST :
                    FileEnum::IMAGE_EXTENSION_LIST;
                if (!in_array(strtolower($fileExtension), $fileExtensionList)) {
                    $validator->addFailure('file', 'Extension', $fileExtensionList);
                }
            }
        });
    }
}
