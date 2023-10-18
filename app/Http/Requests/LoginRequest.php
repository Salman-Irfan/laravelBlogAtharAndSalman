<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            // rules
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
    // if validation errors
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    public function failedValidation(Validator $validator){
        // send error message
        return $validator->errors()->first();
    }
}
