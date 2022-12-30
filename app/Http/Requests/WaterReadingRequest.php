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
            'previous' => 'required|numeric|lte:current',
            'current' => 'required|numeric|gte:previous',
            'month' => 'required|string',
            'rate' => 'required|numeric',
            'unit_id' => 'required|integer|exists:units,id',
        ];
    }

    public function messages()
    {
        return [
            'current.gt' => 'The current reading must be greater than or equal to the previous reading ',
        ];
    }
}
