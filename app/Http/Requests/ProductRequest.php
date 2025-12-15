<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $this->route('product'),
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'gram' => 'nullable|string',
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

            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name may not be greater than 255 characters.',


            'slug.string' => 'The slug must be a string.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',

            'description.string' => 'The description must be a valid string.',

            'price.string' => 'The price must be a string.',

            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected category does not exist.',

        ];
    }
}
