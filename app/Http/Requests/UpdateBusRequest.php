<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRequest extends FormRequest
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
            'id' => 'nullable',
            "color" => 'required',
            "manufacturer_id" => 'required',
            "model_id" => 'required',
            "plate_number" => 'required',
            "vin_number" => 'nullable',
            "chasis_number" => 'nullable',
            "seats" => 'nullable'
        ];
    }
}
