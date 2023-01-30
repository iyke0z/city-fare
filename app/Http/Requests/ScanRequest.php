<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScanRequest extends FormRequest
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
            "trip_no" => 'required', //userid
            "longitude" => 'required',
            "latitude" => 'required',
            "bus_id" => 'required'
        ];
    }
}
