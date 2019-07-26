<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'password' => 'required|string|confirmed|min:6',
            'date_birth' => 'required|date',
            'address'  => 'required|string|min:3',
            'type'  => 'required|string|min:3',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'lic_no' => 'required|numeric',
        ];
    }
}
