<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePanelMemberRequest extends FormRequest
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
            'ta_user_id' => 'sometimes|required',
            'te_user_id' => 'sometimes|required',
            'se_user_id' => 'sometimes|required',
            'ta_iso' => 'required_unless:ta_user_id,null',
            'te_iso' => 'required_unless:te_user_id,null',
            'se_iso' => 'required_unless:se_user_id,null',
        ];
    }

    public function messages()  {
        return [
            'ta_user_id' => 'This field is required',
            'te_user_id' => 'This field is required',
            'se_user_id' => 'This field is required',
            'ta_iso' => 'ISO Form is required',
            'te_iso' => 'ISO Form is required',
            'se_iso' => 'ISO Form is required',
        ];
    }
}
