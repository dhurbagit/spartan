<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
            'media.required' => 'Please upload a product image.',
            'media.file' => 'The media must be a valid file.',
            'media.mimes' => 'Allowed file types are: jpg, jpeg, png, gif, webp, mp4.',
            'media.max' => 'The media file may not be greater than 5MB.',
        ];
    }
}
