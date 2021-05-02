<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class UserRegisterationRequest extends ApiMasterRequest
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
            'name' => 'required|string|max:110',
            'email' => 'required|email:rfc,dns|max:90|unique:users',
            'password' => 'required|string|min:6|max:15',
            'city_id' => 'required|numeric|exists:drop_downs,id',
            'device.id' => 'required',
            'device.os' => 'required|in:android,ios',
        ];
    }
}
