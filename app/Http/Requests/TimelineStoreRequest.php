<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimelineStoreRequest extends FormRequest
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
            'submission_id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'order' => 'required|integer',
        ];
    }
}
