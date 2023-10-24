<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
    public function failedValidation($validator)
    {
        Helper::sendError('Validation error', $validator->errors(), 400);
    }
}
