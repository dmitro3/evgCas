<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'chat_id' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Image is required',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Allowed types: jpeg, png, jpg, gif, webp',
            'image.max' => 'Maximum file size is 5MB',
        ];
    }
}