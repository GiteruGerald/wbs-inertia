<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaterReadingRequest extends FormRequest
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
            'units.*.previous' => 'required|numeric|lte:units.*.current',
            'units.*.current' => 'required|numeric|gte:units.*.previous',
        ];
    }

    public function messages()
    {
        return [
            'units.*.current.gte' => 'The current reading must be greater than or equal to the previous reading ',
            'units.*.previous.lte' => 'The previous reading must be less than or equal to the current reading ',
            'units.*.previous.required' => 'The previous reading value is required',
            'units.*.current.required' => 'The current reading value is required',
        ];
    }
}
