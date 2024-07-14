<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true if authorization logic is implemented
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|between:0,100',
            'website_url' => 'required|url',
            'is_hidden' => 'nullable',
            'description' => 'required|string',
            'details' => 'required|string',
            'usage_limit' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed image formats and max file size as needed
            'start_date' => 'required|date',
            'expiration_date' => 'required|date|after:start_date',
            'sku'=>'required|max:8',
            'category_id'=>'required|integer',
            'store_id'=>'nullable|integer',
            'brand_id'=>'nullable|integer',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'percentage.required' => 'The percentage field is required.',
            'percentage.numeric' => 'The percentage must be a number.',
            'percentage.between' => 'The percentage must be between 0 and 100.',
            'website_url.url' => 'Please enter a valid URL for the website URL.',
            'description.required' => 'The description field is required.',
            'details.required' => 'The details field is required.',
            'usage_limit.integer' => 'The usage limit must be an integer.',
            'usage_limit.min' => 'The usage limit must be at least 0.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'image.max' => 'The image must not be larger than 2MB.',
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'expiration_date.required' => 'The expiration date field is required.',
            'expiration_date.date' => 'The expiration date must be a valid date.',
            'expiration_date.after' => 'The expiration date must be after the start date.',
            'sku'=>'The sku field is required',
            'sku.max'=>'The sku field must not exceed 8 letter',
            'category_id'=>'The Category field is required',
        ];
    }
}
