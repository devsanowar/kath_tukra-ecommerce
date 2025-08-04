<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpazilaStoreRequest extends FormRequest
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
            'upazila_name' =>'required|string|max:255|unique:upazilas,upazila_name',
            'district_id' =>'required',
            'is_active'     => 'required|in:0,1',
        ];
    }
}
