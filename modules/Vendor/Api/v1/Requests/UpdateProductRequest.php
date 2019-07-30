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

            "name"          =>'required|alpha|max:255',
            "images"        =>'required',
            "category"      =>'required',
            "location"      =>'required',
            "monthly_price" =>'required',
            "description"   =>'required',
        ];
    }
}
