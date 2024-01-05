<?php

namespace App\Http\Controllers;

use App\Models\Korpa;

class KorpaController extends Controller
{
    // api ruta -> vraca sadrzaj korpe korisnika
    public function index($korisnik_id)
    {
        $korpa = Korpa::with('stavke.knjiga')->where('korisnik_id', $korisnik_id)->first();

        if (!$korpa) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Korisnik id ' . $korisnik_id . ' ne postoji',
            ], 404);
        }

        $stavke = $korpa->stavke->map(function ($stavka) {
            $cena_stavke = $stavka->knjiga->cena * $stavka->kolicina;
            return [
                'knjiga_id' => $stavka->knjiga->knjiga_id,
                'naziv_knjige' => $stavka->knjiga->naziv,
                'autori' => $stavka->knjiga->autori->pluck('ime', 'prezime')->implode(', '),
                'izdavac' => $stavka->knjiga->izdavac->where('izdavac_id', $stavka->knjiga->izdavac_id)->pluck('naziv')->first(),
                'cena' => $stavka->knjiga->cena,
                'kolicina' => $stavka->kolicina,
                'cena_stavke' => $cena_stavke,
            ];
        })->unique('naziv_knjige');

        $ukupna_cena_korpe = $stavke->sum('cena_stavke');

        return response()->json([
            'status' => 'Uspeh',
            'korpa' => $stavke->values()->all(),
            'ukupna_cena_korpe' => $ukupna_cena_korpe,
        ], 200);
    }

    // api ruta -> prazni korpu konkretnog korisnika
    public function destroy($korisnik_id)
    {
        $korpa = Korpa::where('korisnik_id', $korisnik_id)->first();

        if (!$korpa) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Korisnik ne postoji',
            ], 404);
        }

        $korpa->stavke()->delete();
        return response()->json([
            'status' => 'USpeh',
            'poruka' => 'Korpa uspesno ispraznjena',
        ], 200);
    }
}
