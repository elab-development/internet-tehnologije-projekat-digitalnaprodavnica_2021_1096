<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Izdavac;
use App\Models\Knjiga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KnjigaController extends Controller
{
    // api ruta -> vraca sve knjige
    public function index()
    {
        $knjige = Knjiga::with('autori')->paginate();

        if (!$knjige) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoje knjige u sistemu'
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'knjige' => $knjige->items(),
        ], 200);
    }

    // api ruta -> kreira jednu knjigu
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|unique:knjiga,isbn',
            'naziv' => 'required|string',
            'kategorija' => 'required|string',
            'opis' => 'required|string|unique:knjiga,opis',
            'pismo' => 'required|string',
            'godina' => 'required|integer|digits:4',
            'strana' => 'required|integer',
            'izdavac_id' => 'required|exists:izdavac,izdavac_id',
            'autor' => 'required|array',
            'autor.*' => 'exists:autor,autor_id',
            'cena' => 'required|numeric',
        ]);

        $knjiga = Knjiga::create([
            'isbn' => $request->isbn,
            'naziv' => $request->naziv,
            'kategorija' => $request->kategorija,
            'opis' => $request->opis,
            'pismo' => $request->pismo,
            'godina' => $request->godina,
            'strana' => $request->strana,
            'izdavac_id' => $request->izdavac_id,
            'cena' => $request->cena,
        ]);

        $knjiga->autori()->sync($request->autori);

        return response()->json([
            'status' => 'Uspeh',
            'knjiga' => $knjiga,
        ], 201);
    }

    // api ruta -> prikazuje jednu knjigu
    public function show($id)
    {
        $knjiga = Knjiga::with('autori')->where('knjiga_id', $id)->first();
        if (!$knjiga) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'knjiga' => $knjiga,
        ], 201);
    }

    // api ruta -> menja podatke o konkretnoj knjizi
    public function update(Request $request, $id)
    {
        $knjiga = Knjiga::where('knjiga_id', $id)->first();

        if (!$knjiga) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        $request->validate([
            'isbn' => 'string|unique:knjiga,isbn',
            'naziv' => 'string',
            'kategorija' => 'string',
            'opis' => 'string|unique:knjiga,opis',
            'pismo' => 'string',
            'godina' => 'integer|digits:4',
            'strana' => 'integer',
            'cena' => 'numeric',
            'izdavac_id' => 'exists:izdavac,id'
        ]);

        $knjiga->update([
            'isbn' => $request->isbn === null ? $knjiga->isbn : $request->isbn,
            'naziv' => $request->naziv === null ? $knjiga->naziv : $request->naziv,
            'kategorija' => $request->kategorija === null ? $knjiga->kategorija : $request->kategorija,
            'opis' => $request->opis === null ? $knjiga->opis : $request->opis,
            'pismo' => $request->pismo === null ? $knjiga->pismo : $request->pismo,
            'godina' => $request->godina === null ? $knjiga->godina : $request->godina,
            'strana' => $request->strana === null ? $knjiga->strana : $request->strana,
            'cena' => $request->cena === null ? $knjiga->cena : $request->cena,
            'izdavac_id' => $request->izdavac_id === null ? $knjiga->izdavac_id : $request->izdavac_id,
        ]);

        if ($request->has('autori')) {
            $knjiga->autori()->sync($request->autori);
        }

        return response()->json([
            'status' => 'Uspeh',
            'knjiga' => $knjiga,
        ], 200);
    }

    // api ruta -> brise konkretnu knjigu
    public function destroy($id)
    {
        $knjiga = Knjiga::where('knjiga_id', $id)->first();

        if (!$knjiga) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        $knjiga->delete();

        return response()->json([
            'status' => 'Uspeh',
        ], 200);
    }

    // api ruta -> vraca knjige u kategoriji
    public function vratiKnjigeUKategoriji($kategorija)
    {
        $knjige = Knjiga::where('kategorija', $kategorija)->get();

        if (!$knjige) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoje knjige u toj kategoriji',
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'knjige' => $knjige,
        ], 200);
    }

    // api ruta -> dodaje pdf fajl za konkretnu knjigu
    public function dodajPDF(Request $request, $knjiga_id)
    {
        $knjiga = Knjiga::where('knjiga_id', $knjiga_id)->first();

        if (!$knjiga) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        if ($request->hasFile('pdf_fajl') && $request->file('pdf_fajl')->isValid()) {
            $knjiga->dodajPDF($request->file('pdf_fajl'));

            return response()->json([
                'status' => 'Uspeh',
                'poruka' => 'PDF fajl uspesno dodat',
            ], 200);
        }

        return response()->json([
            'status' => 'Neuspeh',
            'poruka' => 'Greska prilikom dodavanja PDF fajla'
        ], 400);
    }

    public function preuzmiPDF($knjiga_id)
    {
        $knjiga = Knjiga::where('knjiga_id', $knjiga_id)->first();

        if (!$knjiga) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        if (!$knjiga->pdf_path) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'PDF nije dostupan za ovu knjigu',
            ], 404);
        }

        $pdf_path = public_path('storage/' . $knjiga->pdf_path);

        if (!file_exists($pdf_path)) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'PDF fajl nije pronađen',
            ], 404);
        }

        return response()->file($pdf_path);
    }
}
