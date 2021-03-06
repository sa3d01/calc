<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class LoginRequest extends ApiMasterRequest
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
            'phone' => 'required|max:90|exists:users',
            'mobile_country_label' => 'nullable|max:90',
            'password' => 'required|string|min:6|max:20',
            'device.id' => 'required',
            'device.os' => 'required|in:android,ios',
        ];
    }
}
