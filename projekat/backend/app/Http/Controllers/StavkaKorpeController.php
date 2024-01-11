<?php

namespace App\Http\Controllers;

use App\Models\StavkaKorpe;
use App\Models\Knjiga;
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
                'status' => 'Neuspeh',
                'poruka' => 'Korisnik ne postoji ' . $korisnik_id,
            ], 404);
        }

        $request->validate([
            'knjiga_id' => 'required|integer|exists:knjiga,knjiga_id',
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
            'status' => 'Uspeh',
        ], 200);
    }

    // api ruta -> brise stavku konkretnog korisnika
    public function destroy($korisnik_id, $broj_stavke)
    {
        $korpa = Korpa::where('korisnik_id', $korisnik_id)->first();

        if ($korpa) {
            $stavke = $korpa->stavke;

            if ($broj_stavke <= count($stavke)) {
                $stavka_za_brisanje = $stavke->get($broj_stavke - 1);
                $stavka_za_brisanje->delete();

                return response()->json([
                    'status' => 'Uspeh',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Neuspeh',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Korisnik ne postoji',
            ], 404);
        }
    }
}
