<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group_code' => 'required|exists:students,group_code',
            'name' => 'nullable',
            'email' => 'nullable',
            'title' => 'nullable',
            'description' => 'nullable',
            'document' => 'nullable',
            'consultation_name' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
