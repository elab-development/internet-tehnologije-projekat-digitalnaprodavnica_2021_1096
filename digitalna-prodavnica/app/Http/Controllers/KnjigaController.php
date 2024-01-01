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
    // vrati sve knjige
    public function index()
    {
        $knjige = Knjiga::paginate();

        if (!$knjige) {
            return response()->json([
                'poruka' => 'Ne postoje knjige u sistemu'
            ], 404);
        }

        return response()->json([
            'knjige' => $knjige,
        ], 200);
    }

    // kreiraj jednu knjigu
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
            'izdavac_id' => 'required|exists:izdavac,id'
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
        ]);

        return response()->json([
            'Knjiga' => $knjiga,
        ], 201);
    }

    // prikazi jednu knjigu
    public function show($id)
    {
        $knjiga = Knjiga::with('autori')->where('knjiga_id', $id)->first();
        if (!$knjiga) {
            return response()->json([
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        return response()->json([
            'knjiga' => $knjiga,
        ], 201);
    }

    // promeni jednu knjigu
    public function update(Request $request, $id)
    {
        $knjiga = Knjiga::where('knjiga_id', $id)->first();

        if (!$knjiga) {
            return response()->json([
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

        return response()->json([
            'poruka' => 'Uspesna izmena',
            'knjiga' => $knjiga,
        ], 200);
    }

    // izbrisi jednu knjigu
    public function destroy($id)
    {
        $knjiga = Knjiga::where('knjiga_id', $id)->first();

        if (!$knjiga) {
            return response()->json([
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        $knjiga->delete();

        return response()->json([
            'poruka' => 'Uspesno brisanje',
        ], 200);
    }

    // vrati knjige u kategoriji
    public function vratiKnjigeUKategoriji($kategorija)
    {
        $knjige = Knjiga::where('kategorija', $kategorija)->get();

        if (!$knjige) {
            return response()->json([
                'poruka' => 'Ne postoje knjige u toj kategoriji',
            ], 404);
        }

        return response()->json([
            'knjige' => $knjige,
        ], 200);
    }

    public function dodajPDF(Request $request, $knjiga_id)
    {
        $knjiga = Knjiga::where('knjiga_id', $knjiga_id)->first();

        if (!$knjiga) {
            return response()->json([
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        if ($request->hasFile('pdf_fajl') && $request->file('pdf_fajl')->isValid()) {
            $knjiga->dodajPDF($request->file('pdf_fajl'));

            return response()->json([
                'poruka' => 'PDF fajl uspesno dodat',
            ], 200);
        }

        return response()->json([
            'poruka' => 'Greska prilikom dodavanja PDF fajla'
        ], 400);
    }

    public function preuzmiPDF($knjiga_id)
    {
        $knjiga = Knjiga::where('knjiga_id', $knjiga_id)->first();

        if (!$knjiga) {
            return response()->json([
                'poruka' => 'Knjiga ne postoji',
            ], 404);
        }

        if (!$knjiga->pdf_path) {
            return response()->json([
                'poruka' => 'PDF nije dostupan za ovu knjigu',
            ], 404);
        }

        $pdf_path = $knjiga->pdf_path;
        $pdf = Storage::get($pdf_path);

        return response($pdf)->header('Content-Type', 'application/pdf');
    }
}
