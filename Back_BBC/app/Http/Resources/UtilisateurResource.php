<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UtilisateurResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomComplet' => $this->nomComplet,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'login' => $this->login,
            'role' => $this->role,
            'succursale' => $this->succursale,
        ];
    }
}
