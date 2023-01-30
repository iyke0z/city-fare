<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScanoutRequest extends FormRequest
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
            "type" => 'required|in:user,payg,inst,orgc,worc',
            "trip_no" => 'required',
            "longitude" => 'required',
            "latitude" => 'required',
            "bus_id" => 'required'
        ];
    }
}
