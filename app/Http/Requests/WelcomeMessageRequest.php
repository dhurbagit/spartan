<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WelcomeMessageRequest extends FormRequest
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
            'main_title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'media.required' => 'Please upload a picture or video for the welcome message.',
            'media.mimes' => 'The media must be a file of type: jpg, jpeg, png, gif, webp, mp4.',
            'media.max' => 'The media size must not exceed 5MB.',
            'main_title.required' => 'The main title is required.',
            'sub_title.required' => 'The sub title is required.',
            'description.required' => 'The description is required.',
        ];
    }
}
