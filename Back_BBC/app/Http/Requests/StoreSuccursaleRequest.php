<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuccursaleRequest extends FormRequest
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
            'nom' => 'required',
            'telephone' => [
                    'required',
                    'regex:/^(77|78|70|76)[0-9]{7}$/'
                ],
            'adresse' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
             'nom.required' => 'le nom est requis',
            'telephone.required' => 'le numéro est requis',
            'telephone.regex' => "le format du numéro n'est pas correct",
            'adresse.required' => "l'adresse est requis",
        ];
    }
}
