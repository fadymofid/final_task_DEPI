<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization is allowed for everyone, adjust if needed.
    }


        public function rules()
    {
        return [
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }


    public function messages()
    {
        return [
            'phone_number.exists' => 'The phone number you entered does not exist in our records.',
            'password.required' => 'The password field is required.',
        ];
    }
}

