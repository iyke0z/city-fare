<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClosestBusRequest extends FormRequest
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
            "longitude_from"=>'required',
            "longitude_to"=>'required',
            "latitude_from"=>'required',
            "latitude_to"=>'required',
        ];
    }
}
