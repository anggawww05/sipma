<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'username' => 'required|string',
            'email' => 'required|email:dns',
            'password' => 'nullable|string',
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'study_program' => 'required|string',
            'nim' => 'required|string',
        ];
    }
}
