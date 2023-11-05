<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SalesmanCreateRequest extends FormRequest
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
            'username' => 'nullable|unique:salesmen|string',
            'employee_no' => 'required|unique:salesmen|string',
            'email' => 'required|unique:salesmen|email',
            'mobile' => 'required|unique:salesmen|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'lng' => 'nullable|numeric',
            'lat' => 'nullable|numeric',
            'avatar' => 'nullable|mimes:jpg,png',
            'status' => 'required|in:active,inactive,block',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string',
        ];
    }
}
