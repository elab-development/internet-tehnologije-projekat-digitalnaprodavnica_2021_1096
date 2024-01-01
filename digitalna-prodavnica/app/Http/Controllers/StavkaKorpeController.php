<?php

namespace App\Http\Controllers;

use App\Models\StavkaKorpe;
use App\Http\Requests\StoreStavkaKorpeRequest;
use App\Http\Requests\UpdateStavkaKorpeRequest;
use App\Models\Knjiga;
use App\Models\Korisnik;
use App\Models\Korpa;
use Illuminate\Http\Request;

class StavkaKorpeController extends Controller
{
    // dodavanje nove stavke u korpu
    public function store(Request $request, $korisnik_id)
    {
        $korpa = Korpa::where('korisnik_id', $korisnik_id)->first();

        if (!$korpa) {
            return response()->json([
                'poruka' => 'Korisnik ne postoji ' . $korisnik_id,
            ], 404);
        }

        $request->validate([
            'knjiga_id' => 'required|string|exists:knjiga,knjiga_id',
            'kolicina' => 'required|integer',
        ]);

        $stavka = StavkaKorpe::create([
            'korpa_id' => $korpa->korpa_id,
            'knjiga_id' => $request->knjiga_id,
            'kolicina' => $request->kolicina,
        ]);

        $korpa->stavke()->save($stavka);

        $knjiga = Knjiga::where('knjiga_id', $request->knjiga_id)->first();
        $stavka->knjiga()->associate($knjiga);

        return response()->json([
            'poruka' => 'Uspesno dodavanje stavke u korpu',
            'knjiga' => $stavka->knjiga()->first()->naziv,
            'kolicina' => $request->kolicina,
        ], 200);
    }

    // api ruta -> brise stavku konkretnog korisnika
    public function destroy($stavka_korpe_id)
    {
        //
    }
}
