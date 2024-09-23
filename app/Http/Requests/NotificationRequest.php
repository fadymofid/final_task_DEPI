<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can limit notification sending to specific roles here.
    }

    public function rules()
    {
        return [
            'message' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'The notification message is required.',
        ];
    }
}
