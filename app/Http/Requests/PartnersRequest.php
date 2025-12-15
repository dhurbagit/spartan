<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnersRequest extends FormRequest
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
    public function messages()
    {
        return [
            'media.required' => 'Please upload an image or video.',
            'media.mimes' => 'Only jpg, jpeg, png, gif, webp images and mp4 videos are allowed.',
            'media.max' => 'The image or video size must not exceed 5MB.',
        ];
    }
}
