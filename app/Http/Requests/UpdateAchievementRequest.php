<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAchievementRequest extends FormRequest
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
        $id = $this->route('achievement');
        return [
            'title' => 'required|string|max:255|unique:achievements,title,' . $id,
            'count_number' => 'required|numeric',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20',
            'is_active'    => 'required|in:0,1',
        ];
    }
}
