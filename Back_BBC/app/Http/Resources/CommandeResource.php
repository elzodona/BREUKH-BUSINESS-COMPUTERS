<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date_comm' => $this->date_comm,
            'reduction' => $this->reduction,
            'client' => $this->client,
            'utilisateur' => $this->utilisateur,
            'succ_prod' => $this->succ_prods,
        ];
    }

}
