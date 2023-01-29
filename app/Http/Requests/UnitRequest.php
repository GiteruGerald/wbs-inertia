<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'units.*.unit_no' => 'required|string',
            'units.*.meter_no' => 'required|numeric',
            'units.*.apartment_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'units.*.unit_no.required' => 'Unit No is required.',
            'units.*.unit_no.string' => 'Unit No must be a valid string.',
            'units.*.meter_no.required' => 'Meter No is required.',
            'units.*.meter_no.numeric' => 'Meter No must be a valid number.',
            // 'units.*.meter_no.digits' => 'Meter No must be :digits digits.',
            'units.*.apartment_id' => 'Select Apartment'
        ];
    }
}
