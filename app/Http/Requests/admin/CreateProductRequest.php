<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'stockIn' => 'required|integer|min:0',
            'qty' => 'required|integer|min:0',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'SKU' => 'required|string|unique:products',
            'status' => 'required|in:active,inactive',
            'purchase_cost' => 'required|numeric|min:0',
            'sale_cost' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discount_on_qty' => 'nullable|integer|min:0',
            'discount_date_start' => 'nullable|date',
            'discount_date_end' => 'nullable|date|after_or_equal:discount_date_start',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ];
    }
}
