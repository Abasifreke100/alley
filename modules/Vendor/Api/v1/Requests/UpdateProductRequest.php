<?php

namespace Alley\Modules\Vendor\Api\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            "description"=>'required',
            "category"  =>'required',
            "street"    =>'required',
            "city"      =>'required',
            "state"     =>'required',
            "feature"   =>'required',
            "price"     =>'required',
        ];
    }
}
