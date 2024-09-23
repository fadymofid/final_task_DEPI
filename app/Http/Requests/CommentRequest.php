<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Optionally, restrict who can post comments.
    }

    public function rules()
    {
        return [
            'contents' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'contents.required' => 'The comment contents is required.',
        ];
    }
}
