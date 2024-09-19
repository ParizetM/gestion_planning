<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsencesRequest extends FormRequest
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
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'motif_id' => 'required|exists:motifs,id',
        ];
    }
    /**
     * Summary of messages
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'date_debut.required' => 'La date de début est obligatoire',
            'date_debut.date' => 'La date de début doit être au format JJ/MM/AAAA',
            'date_fin.required' => 'La date de fin est obligatoire',
            'date_fin.date' => 'La date de fin doit être au format JJ/MM/AAAA',
            'user_id.required' => 'L\'utilisateur est obligatoire',
            'user_id.exists' => 'L\'utilisateur n\'existe pas',
            'motif_id.required' => 'Le motif est obligatoire',
            'motif_id.exists' => 'Le motif n\'existe pas',
        ];
    }
}
