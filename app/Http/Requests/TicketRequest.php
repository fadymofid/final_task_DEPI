<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can add logic here to limit who can make tickets.blade.php.
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|in:request,problem',
            'info' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'type.required' => 'The type must be either request or problem.',
            'info.required' => 'The ticket details (info) are required.',
        ];
    }
}
