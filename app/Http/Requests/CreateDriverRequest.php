<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email'	=> 'required',
            'password' => 'required',
            'account_type' => 'required',
            'identity'	=> 'required',
            'dob' => 'required',
            'nin' => 'required|unique:users,nin',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',

        ];
    }
}
