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
            'readings.*.previous' => 'required|numeric|lte:readings.*.current',
            'readings.*.current' => 'required|numeric|gte:readings.*.previous',
        ];
    }

    public function messages()
    {
        return [
            'readings.*.current.gte' => 'The current reading must be greater than or equal to the previous reading ',
            'readings.*.previous.lte' => 'The previous reading must be less than or equal to the current reading ',
            'readings.*.previous.required' => 'The previous reading value is required',
            'readings.*.current.required' => 'The current reading value is required',
        ];
    }
}
