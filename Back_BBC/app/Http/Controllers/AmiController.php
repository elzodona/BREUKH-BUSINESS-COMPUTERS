<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Succursale;
use App\Http\Requests\StoreAmiRequest;
use App\Http\Requests\UpdateAmiRequest;

class AmiController extends Controller
{
    public function listeFriends($succId)
    {
        $test = new Succursale();
        return $test->friends(Ami::query(), $succId);
    }

    public function listeNoFriends($succId)
    {
        $test = new Succursale();
        return $test->noFriends(Succursale::query(), $succId);
    }

    public function listeWaitingFriends($succId)
    {
        $test = new Succursale();
        return $test->waitFriends(Ami::query(), $succId);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAmiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ami $ami)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ami $ami)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmiRequest $request, Ami $ami)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ami $ami)
    {
        //
    }
}
