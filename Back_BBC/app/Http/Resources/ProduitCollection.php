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
    //    $produits = Produit::paginate(4);
        $perPage = $request->input('per_page');
        $produits = Produit::paginate($perPage);

        return [
            "numProd" => SuccProd::where('succursale_id', 1)->count(),
            "data" => [
                "produits" => ProduitResource::collection($produits)
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
