<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotifRequest extends FormRequest
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
            'nom' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'is_accessible_salarie' => '',
        ];
    }
    /**
     * Summary of messages
     *
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.max' => 'Le nom ne doit pas dépasser 100 caractères',
            'description.required' => 'La description est obligatoire',
            'description.max' => 'La description ne doit pas dépasser 255 caractères',
        ];
    }
}
