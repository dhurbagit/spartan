<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomersSaysRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
            'media' => $this->isMethod('post')
            ? 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120'
            : 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'position.required' => 'The position field is required.',
            'message.required' => 'The message field is required.',
            'media.mimes' => 'The media must be a file of type: jpg, jpeg, png, gif, webp.',
            'media.max' => 'The media may not be greater than 5 MB.',
        ];
    }
}
