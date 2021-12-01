<?php

namespace App\Http\Requests\Api\Auth\PasswordReset;

use App\Http\Requests\Api\ApiMasterRequest;

class CheckTokenRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' => 'required|string|max:90|exists:users',
            'code' => 'nullable|numeric|max:9999',
            'phone_country_label' => 'nullable|max:90',
        ];
    }
}
