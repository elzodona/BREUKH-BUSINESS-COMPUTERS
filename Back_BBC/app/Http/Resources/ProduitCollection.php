<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Produit;
use App\Http\Resources\ProduitResource;
use App\Models\SuccProd;

class ProduitCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $succursale = Succursale::findOrFail($succId);
        // return $succursale->produits()->get();
        // $produits = $succursale->produits()->paginate(request('per_page', 4));

        return [
            "numProd" => SuccProd::where('succursale_id', 1)->count(),
            "data" => [
                // "produits" => ProduitResource::collection($produits)
                "produits" => $this->collection
            ],
        ];
    }

    public function paginationInformation($resquest, $paginated, $default)
    {
        return [
            "data" => [
                "link" => $default["meta"]['links'],
                "message" => "Sucess",
                "sucess" => 200
            ]
        ];
    }


}
