<?php

namespace Alley\Modules\Account\Api\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "first_name" =>'required|alpha|max:255',
            "last_name" =>'required|alpha|max:255',
            "address" =>'required|max:255',
            "email"=>'required|string|email|max:255|unique:users',
            "phone_number"=>'required|max:15',
            'password'=>'required|string|min:8|',
            'country' =>'required',
            'state'  =>'required',
            'city'   =>'required',
            'photo'  =>'required',

        ];
    }
}
