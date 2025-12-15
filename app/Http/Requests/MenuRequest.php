<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu_name' => 'required|max:250',
            'page_title' => 'required|max:250',
            'category_slug' => 'required',
            'main_child' => 'required',
            'bannerImage' => $this->isMethod('post')
                ? 'required|file|mimes:jpg,jpeg,png,gif,webp|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'image' => $this->isMethod('post')
                ? 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120'
                : 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'parent_id' => ['nullable', 'required_if:main_child,1', 'integer', 'exists:menus,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'parent_id.required_if' => 'Please select a parent menu when adding a sub-menu.',
            'menu_name.required' => 'Menu name is required.',
        ];
    }
}
