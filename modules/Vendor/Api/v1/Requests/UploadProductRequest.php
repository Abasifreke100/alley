<?php

namespace Alley\Modules\Vendor\Api\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "description" =>'required|string',
            "category"    =>'required|string',
            "street"      =>'required|string',
            "city"        =>'required|string',
            "state"       =>'required|string',
            "feature"     =>'required|string',
            "filename"    => 'required|array',

        ];
    }
}
