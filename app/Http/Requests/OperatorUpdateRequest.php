<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorUpdateRequest extends FormRequest
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
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'type' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email:dns',
            'password' => 'nullable|string|min:6',
        ];
    }
}
