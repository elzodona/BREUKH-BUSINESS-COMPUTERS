<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
   public function rules(): array
    {
        return [
                'libelle' => 'required',
                'photo' => 'required',
                'succursale_id' => 'required|integer',
                'caracteristiques' => 'required|string',
                'description' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'libelle.required' => 'le libelle est requis',
            'photo.required' => "le photo est requis",
            'succursale_id.required' => "le succursale est requis",
            'succursale_id.integer' => "le succursale doit etre un chiffre",
            'caracteristique.required' => "le caracteristique est requis",
            'caracteristique.string' => "le caracteristique doit etre une chaine de caractère",
            'description.required' => "la description est requise",
            'description.string' => "la description doit etre une chaine de caractère",
            // 'valeur.required' => "la valeur est requise",
            // 'unite_id.required' => "l'unite est requis",
            // 'unite_id.integer' => "l'unite doit etre un chiffre",
            
        ];
    }

}
