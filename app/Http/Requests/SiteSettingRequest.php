<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
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
            'footer_message' => ['required', 'string', 'max:500'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'phone_no' => ['required', 'string'],
            'mobile_no' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'zip_code' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'google_map' => 'required',
        ];
    }

   
}
