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
            'units.*.current' => 'required|numeric|lte:units.*.present',
            'units.*.present' => 'required|numeric|gte:units.*.current',
        ];
    }

    public function messages()
    {
        return [
            'units.*.present.gte' => 'The present reading must be greater than or equal to the previous reading ',
            'units.*.current.lte' => 'The current reading must be less than or equal to the present reading ',
            'units.*.current.required' => 'The current reading value is required',
            'units.*.present.required' => 'The present reading value is required',
        ];
    }
}
