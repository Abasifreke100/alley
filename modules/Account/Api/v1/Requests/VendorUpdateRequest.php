<?php

namespace Alley\Modules\Account\Api\v1\Requests;

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

            'agency_name'=>'required|string',
            'agency_address'=>'required|string',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string',

        ];
    }
}
