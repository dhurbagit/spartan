<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'media' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ];
    }
    public function messages(): array
    {
        return [
            'media.required' => 'Please upload a picture for the gallery item.',
            'media.mimes' => 'The media must be a file of type: jpg, jpeg, png, gif, webp.',
            'media.max' => 'The media size must not exceed 5MB.',
            'title.max' => 'The title may not be greater than 255 characters.',
        ];
    }
}
