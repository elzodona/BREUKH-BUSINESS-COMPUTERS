<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\SuccProd;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommandeResource;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;

class CommandeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Commande::class);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Commande::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // $client = Client::findOrFail($request->client_id)->id;
    // $utilisateur = Utilisateur::findOrFail($request->utilisateur_id)->id;

    public function store(Request $request)
    {
        //dd(Auth::user());
        $this->authorize('create', Commande::class);
        try {
            $data = $request->all();

            $uniqueSuccProdIds = collect($data)->pluck('succ_prod_id')->unique();
            // $uniqueSuccProdIds = array_unique(array_column($data, 'succ_prod_id'));
            // return $uniqueSuccProdIds;
            if ($uniqueSuccProdIds->count() !== count($data)) {
                return response()->json(['error' => 'Les succ_prod_id doivent être uniques.'], 400);
            }

            $prix = collect($data)->pluck('prix');
            $montant = 0;
            foreach ($prix as $value) {
                $montant += $value;
            }
            // return $montant;

            $comm = Commande::create([
                'date_comm' => now(),
                'utilisateur_id' => 2,
                'client_id' => 1
            ]);
            
            foreach ($data as $item) {
                $succ_prod_id = $item['succ_prod_id'];
                $prix = $item['prix'];
                $quantite = $item['quantite'];

                $comm->succ_prods()->attach($succ_prod_id, ['prix' => $prix, 'quantite' => $quantite]);
                SuccProd::where('id', $succ_prod_id)->decrement('quantite', $quantite);
            }

            Paiement::create([
                'date_paye' => now(),
                'montant' => $montant,
                'commande_id' => $comm->id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Commande created successfully',
                'commande' => new CommandeResource($comm),
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
