<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;
use App\Models\Marque;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marque::all();
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
    public function store(StoreMarqueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Marque $marque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarqueRequest $request, Marque $marque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {
        //
    }
}
