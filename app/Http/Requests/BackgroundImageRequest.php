<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackgroundImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'media' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'media.required' => 'Please upload a product image.',
            'media.file' => 'The media must be a valid file.',
            'media.mimes' => 'Allowed file types are: jpg, jpeg, png, gif, webp, mp4.',
            'media.max' => 'The media file may not be greater than 5MB.',
        ];
    }
}
