<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'title_1' => 'required|string|max:255',
            'title_2' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'media.required' => 'Please upload an image or video.',
            'media.mimes' => 'Only jpg, jpeg, png, gif, webp images and mp4 videos are allowed.',
            'media.max' => 'The image or video size must not exceed 5MB.',
            'title_1.required' => 'Title 1 is required.',
            'title_1.max' => 'Title 1 must not exceed 255 characters.',
            'title_2.required' => 'Title 2 is required.',
            'title_2.max' => 'Title 2 must not exceed 255 characters.',
            'description.required' => 'Description is required.',
        ];
    }
}
