<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'jobTitle' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'jobType' => 'required|string|max:255',
            'expireDate' => 'required|date',
            'description' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'jobTitle.required' => 'The job title is required.',
            'location.required' => 'The location is required.',
            'jobType.required' => 'The job type is required.',
            'expireDate.required' => 'The date posted is required.',
            'description.required' => 'The description is required.',
        ];
    }
}
