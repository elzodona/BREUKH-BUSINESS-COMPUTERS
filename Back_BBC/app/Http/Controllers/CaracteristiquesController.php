<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caracteristiques;
use App\Http\Requests\StoreCaracteristiquesRequest;
use App\Http\Requests\UpdateCaracteristiquesRequest;

class CaracteristiquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Caracteristiques::all();
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
    public function store(Request $request)
    {
        $carac = Caracteristiques::create([
                'libelle' => $request->libelle
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Caracteristique create successfully',
                'caracteristique' => $carac,
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Caracteristiques $caracteristiques)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caracteristiques $caracteristiques)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaracteristiquesRequest $request, Caracteristiques $caracteristiques)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caracteristiques $caracteristiques)
    {
        //
    }
}
