<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UniteResource;
use App\Http\Resources\CaracteristiquesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdCaractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [];
    }
}
