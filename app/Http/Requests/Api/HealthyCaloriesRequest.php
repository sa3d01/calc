<?php

namespace App\Http\Requests\Api;

class HealthyCaloriesRequest extends ApiMasterRequest
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
            'weight'=>'required|numeric',
            'height'=>'required|numeric',
            'age'=>'required|numeric',
            'gender'=>'required|in:male,female',
            'activity_factor'=>'nullable|in:Sedentary,Light active,Moderately active,Extremely active,Very active',
        ];
    }
}
