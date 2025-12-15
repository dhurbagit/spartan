<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VacancyApplicationRequest extends FormRequest
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
            'vacancy_id' => ['required', 'exists:vacancies,id'],
            'name' => 'required',
            'email' => ['required', 'email', 'unique:vacancy_applications,email'],
            'phone' => 'required',
            'job_title' => 'required',
            'media' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }

    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed, please try again.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email has already applied. Please use a different email.',
        ];
    }

    // for showing error in individual model with error bag
    protected function failedValidation(Validator $validator)
    {
        // which vacancy’s modal was submitted
        $vacancyId = $this->input('vacancy_id');

        // this will be the unique error bag name for that modal
        $bagName = 'apply_' . $vacancyId;

        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator, $bagName)  // 👈 named error bag
                ->withInput()
                ->with('open_modal', $vacancyId)  // 👈 which modal to reopen
        );
    }
}
