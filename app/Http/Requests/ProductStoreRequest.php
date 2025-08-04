<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'category_id'       => 'required|exists:categories,id',
            'subcategory_id'    => 'nullable|exists:sub_categories,id',
            'brand_id'          => 'nullable|exists:brands,id',
            'product_name'      => 'required|string|max:255',
            'product_slug'      => 'nullable|string|max:255|unique:products,product_slug',
            'sku'               => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:1000',
            'long_description'  => 'nullable|string',
            'regular_price'     => 'required|numeric|min:0',
            'discount_price'    => 'nullable|numeric|min:0|lt:regular_price',
            'discount_type'     => 'nullable|in:flat,percent',
            'stock_quantity'    => 'required|integer|min:0',

            // 'in_stock' => 'required|boolean',

            // 'colors' => 'nullable|array',
            // 'colors.*' => 'string|max:20',
             'sizes' => 'nullable|array',
            // 'sizes.*' => 'string|max:10',

            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:300',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'is_featured' => 'required|boolean',
            'is_active'   => 'required|boolean',
        ];
    }


}
