<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Overview;

class OverviewRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'counters_number' => 'required|string|max:5',
            'message' => 'required|string|max:105',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            // Only block create (POST). Allow update (PUT/PATCH).
            if ($this->isMethod('post')) {
                $count = Overview::count();
                if ($count >= 4) {
                    $v->errors()->add('limit', 'You already have 4 records. You cannot add more.');
                }
            }
        });
    }
    public function messages(): array
    {
        return [
            'media.required' => 'Please upload a product image.',
            'media.file' => 'The media must be a valid file.',
            'media.mimes' => 'Allowed file types are: jpg, jpeg, png, gif, webp, mp4.',
            'media.max' => 'The media file may not be greater than 5MB.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 15 characters.',
            'counters_number.required' => 'The counters number field is required.',
            'counters_number.string' => 'The counters number must be a string.',
            'counters_number.max' => 'The counters number may not be greater than 5 characters.',
            'message.required' => 'The message field is required.',
            'message.string' => 'The message must be a string.',
            'message.max' => 'The message may not be greater than 105 characters.',
        ];
    }
}
