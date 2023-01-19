<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadingRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'current.gte' => 'The current reading must be greater than or equal to the previous reading ',
            'previous.lte' => 'The previous reading must be less than or equal to the current reading ',
            'previous.required' => 'The previous reading value is required',
            'current.required' => 'The current reading value is required',
        ];
    }
}
