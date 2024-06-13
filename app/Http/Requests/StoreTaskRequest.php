<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            "company_id" => 'required|integer|exists:companies,id',
            "user_id" => 'required|integer|exists:users,id',
            "name" => 'required|string',
            "description" => 'required|string|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.exists' => 'The selected company does not exists.',
            'user_id.exists' => 'The selected user does not exists.',
        ];
    }
}
