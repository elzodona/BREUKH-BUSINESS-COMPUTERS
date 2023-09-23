<?php

namespace App\Http\Controllers;

use App\Models\Succursale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SuccursaleResource;
use App\Http\Requests\StoreSuccursaleRequest;
use App\Http\Requests\UpdateSuccursaleRequest;

class SuccursaleController extends Controller
{
    
    public function index()
    {
        return SuccursaleResource::collection(Succursale::all());
    }

    public function store(StoreSuccursaleRequest $request)
    {
         return DB::transaction(function () use ($request) {
            $succ = new Succursale();
            $succ->nom = $request->validated()['nom'];
            $succ->telephone = $request->validated()['telephone']; 
            $succ->adresse = $request->validated()['adresse'];

            $succ->save();

            return response()->json(
                [
                    'message' => 'Succursale créé avec succès', 
                    'data' => $succ, 
                    'status' => 201
                ]);
        });
    }

    public function show($nom)
    {
        $succ = Succursale::where('nom',  $nom)->first();

        return response()->json([
            'message' => 'résultat de la recherche',
            'data' => $succ,
            'status' => 200
        ]);
    }

    public function update(UpdateSuccursaleRequest $request, $succId)
    {
        $succ = Succursale::findOrFail($succId);

        $succ->nom = $request->validated()['nom'];
        $succ->telephone = $request->validated()['telephone'];
        $succ->adresse = $request->validated()['adresse'];

        $succ->save();

        return response()->json([
            'message' => 'Succursale mise à jour avec succès',
            'data' => $succ,
            'status' => 200
        ]);
    }

    public function destroy($succId)
    {
        $succ = Succursale::findOrfail($succId);
        $succ->destroy($succId);

        return response()->json([
            'message'=>'succursale supprimé avec succès',
            'succ' => $succ
        ]);
    }


}
