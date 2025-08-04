<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchievementRequest extends FormRequest
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
            'title' => 'bail|required|string|max:255|unique:achievements,title',
            'count_number'   => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:20',
            'is_active'     => 'required|in:0,1',
        ];
    }
}
