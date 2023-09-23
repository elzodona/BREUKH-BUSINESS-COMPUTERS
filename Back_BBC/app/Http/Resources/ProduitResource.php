<?php

namespace App\Http\Resources;

use App\Models\ProdCaract;
use Illuminate\Http\Request;
use App\Http\Resources\ProdCaractResource;
use App\Http\Resources\CaracteristiquesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduitResource extends JsonResource
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
            'libelle' => $this->libelle,
            'code' => $this->code,
            'photo' => $this->photo,
            'categorie' => $this->categorie,
            'marque' => $this->marque,
            'succursale' => $this->succursales,
            'caracteristiques' => $this->caracteristiques
        ];
    }


}
