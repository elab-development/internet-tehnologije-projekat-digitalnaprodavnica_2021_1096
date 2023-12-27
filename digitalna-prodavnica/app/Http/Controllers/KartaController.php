<?php

namespace App\Http\Controllers;

use App\Models\Karta;
use App\Http\Requests\StoreKartaRequest;
use App\Http\Requests\UpdateKartaRequest;
use App\Models\Utakmica;

class KartaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karte = Karta::paginate();

        if (!$karte) {
            return response()->json(['poruka' => 'Ne postoje karte u sistemu'], 404);
        }

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
        $karta = Karta::where('brojKarte', $brojKarte)->first();

        if (!$karta) {
            return response()->json(['poruka' => 'Ne postoji karta sa brojem: ' . $brojKarte], 404);
        }

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

    public function vratiKartePoSportu($tipSporta)
    {
        $utakmice = Utakmica::where('tipSporta', $tipSporta)->pluck('utakmicaId');
        $karte = Karta::whereIn('utakmicaId', $utakmice)->get();

        if (!$karte) {
            return response()->json(['poruka' => 'Ne postoje utakmice u kategoriji sporta: ' . $tipSporta], 404);
        }

        return response()->json($karte, 200);
    }
}
