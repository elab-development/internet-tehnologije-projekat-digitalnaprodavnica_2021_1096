<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Izdavac;
use App\Models\Knjiga;
use Illuminate\Http\Request;

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
            'autor_id' => 'required|exists:autor,id',
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
            'autor_id' => $request->autor_id,
            'izdavac_id' => $request->izdavac_id,
        ]);

        return response()->json([
            'Knjiga' => $knjiga,
        ], 201);
    }

    // prikazi jednu knjigu
    public function show($id)
    {
        $knjiga = Knjiga::where('id', $id)->first();
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
        $knjiga = Knjiga::where('id', $id)->first();

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
            'autor_id' => 'exists:autor,id',
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
            'autor_id' => $request->autor_id === null ? $knjiga->autor_id : $request->autor_id,
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
        $knjiga = Knjiga::where('id', $id)->first();

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
    public function vratiKnjigeUKategoriji(Request $request, $kategorija)
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

    // vrati knjige po autorima
    public function vratiKnjigePoAutorima(Request $request, $autor_id)
    {
        $knjige = Knjiga::where('autor_id', $autor_id)->get();

        if (!$knjige) {
            return response()->json([
                'poruka' => 'Autor nema nijednu knjigu'
            ], 404);
        }
        $autor = Autor::where('id', $autor_id)->first();

        return response()->json([
            'autor' => $autor,
            'knjige' => $knjige,
        ], 200);
    }

    // vrati knjige po izdavacima
    public function vratiKnjigePoIzdavacima(Request $request, $izdavac_id)
    {
        $knjige = Knjiga::where('izdavac_id', $izdavac_id)->get();

        if (!$knjige) {
            return response()->json([
                'poruka' => 'Izdavac nema nijednu knjigu'
            ], 404);
        }
        $izdavac = Izdavac::where('id', $izdavac_id)->first();

        return response()->json([
            'izdavac' => $izdavac,
            'knjige' => $knjige,
        ], 200);
    }
}
