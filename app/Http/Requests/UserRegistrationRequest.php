<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;


class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
        ];
    }
}
