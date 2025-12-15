<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SisterCompanyRequest extends FormRequest
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
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image_one' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120',
            'cover_image_two' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4|max:5120',
            'cover_title_one' => 'required|string|max:255',
            'cover_title_two' => 'required|string|max:255',
            'link_one' => 'nullable|url|max:255',
            'link_two' => 'nullable|url|max:255',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'Title must not exceed 255 characters.',
            'subtitle.required' => 'Subtitle is required.',
            'subtitle.max' => 'Subtitle must not exceed 255 characters.',
            'description.required' => 'Description is required.',
            'cover_image_one.required' => 'Cover Image One is required.',
            'cover_image_one.mimes' => 'Only jpg, jpeg, png, gif, webp images and mp4 videos are allowed for Cover Image One.',
            'cover_image_one.max' => 'The Cover Image One size must not exceed 5MB.',
            'cover_image_two.required' => 'Cover Image Two is required.',
            'cover_image_two.mimes' => 'Only jpg, jpeg, png, gif, webp images and mp4 videos are allowed for Cover Image Two.',
            'cover_image_two.max' => 'The Cover Image Two size must not exceed 5MB.',
            'cover_title_one.required' => 'Cover Title One is required.',
            'cover_title_one.max' => 'Cover Title One must not exceed 255 characters.',
            'cover_title_two.required' => 'Cover Title Two is required.',
            'cover_title_two.max' => 'Cover Title Two must not exceed 255 characters.',
            'link_one.url' => 'Link One must be a valid URL.',
            'link_one.max' => 'Link One must not exceed 255 characters.',
            'link_two.url' => 'Link Two must be a valid URL.',
            'link_two.max' => 'Link Two must not exceed 255 characters.',
        ];
    }
}
