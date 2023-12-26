<?php

namespace App\Http\Controllers;

use App\Models\Karta;
use App\Http\Requests\StoreKartaRequest;
use App\Http\Requests\UpdateKartaRequest;

class KartaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karte = Karta::all();
        return response()->json($karte, 200);
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
    public function store(StoreKartaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($brojKarte)
    {
        $karta = Karta::where('brojKarte', $brojKarte)->firstOrFail();
        return response()->json($karta, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karta $karta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKartaRequest $request, Karta $karta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karta $karta)
    {
        //
    }
}
