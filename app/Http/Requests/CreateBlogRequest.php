<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function failedValidation($validator)
    {
        Helper::sendError('Validation error', $validator->errors(), 400);
    }
}
