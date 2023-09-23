<?php

namespace App\Http\Controllers;

use App\Models\Unite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUniteRequest;
use App\Http\Requests\UpdateUniteRequest;

class UniteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Unite::all();
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
        $unite = Unite::create([
                'libelle' => $request->libelle
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Caracteristique create successfully',
                'unité' => $unite,
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unite $unite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unite $unite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniteRequest $request, Unite $unite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unite $unite)
    {
        //
    }
}
