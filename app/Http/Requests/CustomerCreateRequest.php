<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
            'username' =>'required|min:6',
            'shopname' => 'required|min:6',
            'email' =>'required|unique:customers,email',
            'mobile' =>'required|unique:customers,mobile',
            'password' =>'required'
        ];
    }
}
