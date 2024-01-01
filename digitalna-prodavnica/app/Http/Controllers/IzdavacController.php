<?php

namespace App\Http\Controllers;

use App\Models\Izdavac;
use App\Http\Requests\StoreIzdavacRequest;
use App\Http\Requests\UpdateIzdavacRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class IzdavacController extends Controller
{
    // api ruta -> vraca sve izdavace
    public function index()
    {
        $izdavaci = Izdavac::paginate();

        if (!$izdavaci) {
            return response()->json([
                'poruka' => 'Ne postoje izdavaci u sistemu'
            ], 404);
        }

        return response()->json([
            'izdavaci' => $izdavaci,
        ], 200);
    }

    // api ruta -> kreira jednog izdavaca
    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|unique:izdavac,naziv',
            'adresa' => 'required|string',
        ]);

        $izdavac = Izdavac::create([
            'naziv' => $request->naziv,
            'adresa' => $request->adresa,
        ]);

        return response()->json([
            'izdavac' => $izdavac,
        ], 201);
    }

    // api ruta -> prikazuje konkretnog izdavaca
    public function show($id)
    {
        $izdavac = Izdavac::where('izdavac_id', $id)->first();
        if (!$izdavac) {
            return response()->json([
                'poruka' => 'Izdavac ne postoji',
            ], 404);
        }

        return response()->json([
            'izdavac' => $izdavac,
        ], 200);
    }

    // api ruta -> menja podatke o konkretnom izdavacu
    public function update(Request $request, $id)
    {
        $izdavac = Izdavac::where('izdavac_id', $id)->first();

        if (!$izdavac) {
            return response()->json([
                'poruka' => 'Izdavac ne postoji',
            ], 404);
        }

        $request->validate([
            'naziv' => 'string|unique:izdavac,naziv',
            'adresa' => 'string',
        ]);

        $izdavac->update([
            'naziv' => $request->naziv === null ? $izdavac->naziv : $request->naziv,
            'adresa' => $request->adresa === null ? $izdavac->adresa : $request->adresa,
        ]);

        return response()->json([
            'poruka' => 'Uspesna izmena',
            'izdavac' => $izdavac,
        ], 200);
    }

    // api ruta -> brise konkretnog izdavaca
    public function destroy($id)
    {
        $izdavac = Izdavac::where('izdavac_id', $id)->first();

        if (!$izdavac) {
            return response()->json([
                'poruka' => 'Izdavac ne postoji',
            ], 404);
        }

        $izdavac->delete();

        return response()->json([
            'poruka' => 'Uspesno brisanje',
        ], 200);
    }

    // api ruta -> vraca knjige od izdavaca 
    public function vratiKnjigeIzdavaca($izdavac_id)
    {
        $izdavac = Izdavac::with('knjige')->where('izdavac_id', $izdavac_id)->first();

        if (!$izdavac) {
            return response()->json([
                'poruka' => 'Izdavac ne postoji',
            ], 404);
        }

        return response()->json([
            'izdavac' => $izdavac,
        ], 200);
    }
}
