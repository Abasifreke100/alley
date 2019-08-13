<?php

namespace Alley\Modules\Vendor\Api\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdateRequest extends FormRequest
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

            "vendor_name"        =>'required',
            "location"           =>'required',
            "email"              =>'required',
            "phone_number"       =>'required',
            'password'           =>'required|min:8',
        ];
    }
}
