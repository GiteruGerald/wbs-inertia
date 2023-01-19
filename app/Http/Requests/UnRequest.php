<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnRequest extends FormRequest
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
            'unit_no' => 'required|string',
            'meter_no' => 'required|numeric|digits:3',
            'type' => 'string'
        ];
    }
    public function messages()
    {
        return [
            'unit_no.required' => 'Unit No is required.',
            'unit_no.string' => 'Unit No must be a valid string.',
            'meter_no.required' => 'Meter No is required.',
            'meter_no.numeric' => 'Meter No must be a valid number.',
            'meter_no.digits' => 'Meter No must be :digits digits.',
        ];
    }
}
