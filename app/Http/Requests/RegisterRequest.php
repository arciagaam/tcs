<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

        // dd($this->all());
        return [
            'thesis_title' => 'required',
            'group_code' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'year' => 'required',
            'section' => 'required',
            'ta_user_id' => 'required',
            'te_user_id' => 'required',
            'se_user_id' => 'required',
            'ta_iso' => 'required',
            'te_iso' => 'required',
            'se_iso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ta_user_id' => [
                'required' => 'Select a thesis adviser'
            ],

            'te_user_id' => [
                'required' => 'Select a technical editor'
            ],

            'se_user_id' => [
                'required' => 'Select a system expert'
            ],

            'ta_iso' => [
                'required' => 'Submit ISO for Thesis Adviser'
            ],

            'te_iso' => [
                'required' => 'Submit ISO for Technical Editor'
            ],

            'se_iso' => [
                'required' => 'Submit ISO for System Expert'
            ],


        ];
    }
}
