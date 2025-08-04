<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryUpdateRequest extends FormRequest
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
            'subcategory_name' => 'required|string|max:255',
            'subcategory_slug' => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:100',
            'is_active'     => 'required|in:0,1',
        ];
    }
}
