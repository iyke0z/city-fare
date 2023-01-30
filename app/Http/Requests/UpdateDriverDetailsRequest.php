<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverDetailsRequest extends FormRequest
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
            "lisence_no" => 'nullable|unique:driver_details,lisence_no,'.$this->id,
            "issue_date" => 'nullable',
            "expiry_date" => 'nullable',
            "is_verified" => 'nullable',
            "years_of_experience" => 'nullable',
        ];
    }
}
