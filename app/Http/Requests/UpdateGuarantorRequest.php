<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuarantorRequest extends FormRequest
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
            "fullname" => 'required',
            "nin" => 'nullable',
            "email_address" => 'nullable',
            "phone" => 'required|unique:guarantors,phone,'.$this->id,
            "address" => 'required',
        ];
    }
}
