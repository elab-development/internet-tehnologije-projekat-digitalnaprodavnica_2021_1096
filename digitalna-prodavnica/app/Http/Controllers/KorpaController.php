<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use App\Http\Requests\StoreKorpaRequest;
use App\Http\Requests\UpdateKorpaRequest;
use App\Models\Knjiga;
use App\Models\Korisnik;
use Illuminate\Http\Request;

class KorpaController extends Controller
{
    // vrati korpu za korisnika
    public function index($korisnik_id)
    {
        $korpa = Korpa::with('stavke.knjiga')->where('korisnik_id', $korisnik_id)->first();

        if (!$korpa) {
            return response()->json([
                'poruka' => 'Korisnik ne postoji ' . $korisnik_id,
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
            'korpa' => $stavke->values()->all(),
            'ukupna_cena_korpe' => $ukupna_cena_korpe,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
