<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
            'identity'	=> 'nullable',
            'dob' => 'nullable',
            'nin' => 'nullable|unique:users,nin',
            'address' => 'nullable',
            'country_id' => 'nullable',
            'state_id' => 'nullable',

            "lisence_no" => 'nullable|unique:driver_details,lisence_no,'.$this->id,
            "issue_date" => 'nullable',
            "expiry_date" => 'nullable',
            "is_verified" => 'nullable',
            "years_of_experience" => 'nullable',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'status_code' => '011',
                    'message' => 'Some required fields are missing or empty!',
                    'errors' => $errors
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
