<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'month'=> 'required|string',
            'rate'=> 'required|numeric',
            'bill_date'=> 'required|date',
            'issue_date'=> 'required|date|after_or_equal:bill_date',
            'due_date'=> 'required|date|after:issue_date',
            'apartment_id'=> 'required|numeric',
        ];
    }
}
