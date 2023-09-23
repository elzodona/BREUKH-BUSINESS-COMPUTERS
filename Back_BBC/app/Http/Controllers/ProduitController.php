<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ami;
use App\Models\Unite;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\SuccProd;
use App\Models\Categorie;
use App\Models\Succursale;
use Illuminate\Http\Request;
use App\Models\Caracteristiques;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProduitResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Resources\SuccursaleResource;
use App\Http\Requests\UpdateProduitRequest;


class ProduitController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Produit::class);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProduitResource::collection(Produit::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Produit::class);
        // dd(auth()->user()->role);
        try {
            $code = Carbon::now()->format('YmdHis');

            $succ = Succursale::where('id', $request->succursale_id)->first()->id;

            $imagePath = str_replace('data:image/jpeg;base64,', '', $request->photo_name);
            $fileName = $request->photo;

            Storage::disk('public')->put($fileName, base64_decode($imagePath));

            $categorie_id  = Categorie::findOrFail($request->categorie)->id;
            $marque_id  = Marque::findOrFail($request->marque)->id;
            // return $marque_id;

            $prod = Produit::create([
                'libelle' => $request->libelle,
                'code' => $code,
                'photo' => $fileName,
                'categorie_id' => $categorie_id,
                'marque_id' => $marque_id
            ]);
            
            $prod->succursales()->attach($succ, ['quantite'=>$request->qte, 'prix_unitaire'=>$request->prix]);

            $car = $request->caracts;
            foreach ($car as $value) {
                if (isset($value["unite"]) && is_numeric($value["unite"])) {
                    $prod->caracteristiques()->attach($value["caracteristique"], ["valeur"=>$value["valeur"], "unite_id"=>$value["unite"]]);
                } else {
                    $prod->caracteristiques()->attach($value["caracteristique"], ["valeur"=>$value["valeur"]]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Produit create successfully',
                'produit' => new ProduitResource($prod),
            ], 200);

        } catch (\Throwable $th) {
            var_dump($th); 
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500
            );
        }

    }

    /**
     * Display the specified resource.
     */

    public function searchProd($succId, $code)
    {
        $produit = Produit::where('code', $code)->first();

        if (!$produit) {
            return response()->json(['message' => 'produit not found']);
        }
        // return $produit;

        $succ_prod = SuccProd::where('produit_id', $produit->id)
                              ->where('succursale_id', $succId)
                              ->first();
        // return $succ_prod;

        $qte = $succ_prod->quantite;
        
        if ($qte != 0) {
            return response()->json([
                'photo' => $produit->photo,
                'produit' => new ProduitResource($produit)
            ]);            
        }

        $amis = Succursale::find($succId);
        // $amis->load([
        //     "amis"=>function($q) use ($succId){
        //         $q->where(["accepted"=>1]);
        //         //   ->orWhere(["accepted"=>1, "friendB"=>$succId]);
        //     }
        // ]);
        $test = new Succursale();
        $friends = $test->friends(Ami::query(), $succId);

        $amisArray = $friends->map(function ($a) {
            return $a;
        });
        //return $amisArray;
        $ifFriends = [];

        foreach ($amisArray as $item) {
            if ($item['friendA'] != 1) {
                $ifFriends[] = $item['friendA'];
            }
            if ($item['friendB'] != 1) {
                $ifFriends[] = $item['friendB'];
            }
        }
        //return $ifFriends;
        
        $tab = [];
        foreach ($ifFriends as $id) {
            $succ_prod = SuccProd::where('produit_id', $produit->id)
                ->where('succursale_id', $id)
                ->first();

            if ($succ_prod && $succ_prod->quantite > 0) {
                $succursale = Succursale::find($succ_prod->succursale_id);
                $succ_prod_id = SuccProd::where('succursale_id', $succursale->id)->where('produit_id', $produit->id)->first()->id;
                $tab[] = [
                    'succ_prod_id' => $succ_prod_id,
                    'nom' => $succursale->nom,
                    'quantite' => $succ_prod->quantite,
                    'prix' => $succ_prod->prix_unitaire,
                    'prix_gros' => $succ_prod->prix_en_gros
                ];
            }
        }

        return response()->json([
            'amis' => $tab,
            'photo' => $produit->photo,
            'produit' => new ProduitResource($produit),
        ]); 
    }


}
