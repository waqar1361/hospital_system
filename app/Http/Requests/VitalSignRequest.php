<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalSignRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'blood_pressure' => 'nullable',
            'pulse'          => 'nullable',
            'respiration'    => 'nullable',
            'temperature'    => 'nullable',
            'height'         => 'nullable',
            'weight'         => 'nullable',
            'bmi'            => 'nullable',
        ];
    }
}
