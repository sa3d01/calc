<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'title' => 'nullable|string|max:110',
            'note' => 'nullable|string|max:400',
            'start_date' => 'nullable|date|after:yesterday',
            'end_date' => 'nullable|after:today',
            'image' => 'required|mimes:png,jpg,jpeg',
        ];
    }

}
