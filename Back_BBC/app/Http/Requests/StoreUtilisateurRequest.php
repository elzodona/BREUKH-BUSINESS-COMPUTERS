<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUtilisateurRequest extends FormRequest
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
                'nomComplet' => 'required',
                'login' => 'required|unique:utilisateurs,login',
                'password' => 'required',
                'telephone' => 'required',
                'adresse' => 'required',
                'role' => 'required',
                'succursale_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nomComplet.required' => 'le nom est requis',
            'login.required' => "le login est requis",
            'telephone.required' => "le telephone est requis",
            'adresse.required' => "l'adresse est requis",
            'role.required' => "le role est requis",
            'password.required' => 'le password est requis',
            'succursale_id.required' => 'le succursale est requis'
        ];
    }

}

