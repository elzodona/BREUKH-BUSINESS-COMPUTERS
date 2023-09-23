<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'commandes' => $this->commandes,
        ];
    }


}
