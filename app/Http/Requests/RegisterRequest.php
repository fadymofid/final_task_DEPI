<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users.blade.php to register
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:6|confirmed', // Ensure password confirmation
        ];
    }

    public function messages()
    {
        return [
            'phone_number.unique' => 'The phone number has already been taken.',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }
}
