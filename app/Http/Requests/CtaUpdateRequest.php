<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CtaUpdateRequest extends FormRequest
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
            'title' =>'required|string|max:255',
            'sub_title' =>'nullable|string|max:255',
            'content' =>'nullable',
            'button_name' =>'nullable|string|max:255',
            'button_url' =>'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500',
        ];
    }
}
