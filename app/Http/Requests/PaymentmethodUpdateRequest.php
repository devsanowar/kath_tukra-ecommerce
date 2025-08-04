<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentmethodUpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('paymentmethods', 'name')->ignore($this->id),
            ],
            'payment_number' => [
                'required',
                'regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            ],
            'method_type' => 'required',
            'image' => [
                'nullable', // update এ নতুন ইমেজ নাও আসতে পারে
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:150',
            ],
        ];
    }
}
