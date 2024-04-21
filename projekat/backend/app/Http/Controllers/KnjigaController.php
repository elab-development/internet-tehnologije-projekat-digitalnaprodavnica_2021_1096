<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Knjiga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KnjigaController extends Controller
{
    // api ruta -> vraca sve knjige
    public function index()
    {
        $knjige = Knjiga::with('autori')->get();

        if (!$knjige) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoje knjige u sistemu'
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'knjige' => $knjige,
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
            'izdavac.izdavac_id' => 'required|exists:izdavac,izdavac_id',
            'cena' => 'required|numeric',
            'autori' => 'required|array',
            'autori.*.autor_id' => 'required|exists:autor,autor_id',
            'autori.*.ime' => 'required|string',
            'autori.*.prezime' => 'required|string',
            'autori.*.datum_rodjenja' => 'required|date',
            'autori.*.mesto_rodjenja' => 'required|string',
            'autori.*.biografija' => 'required|string',
        ]);

        foreach ($request->autori as $autor) {
            if (!Autor::find($autor['autor_id'])) {
                return response()->json([
                    'status' => 'Neuspeh',
                    'poruka' => 'Jedan od unetih autora ne postoji'
                ], 404);
            }
        }

        $knjiga = Knjiga::create([
            'isbn' => $request->isbn,
            'naziv' => $request->naziv,
            'kategorija' => $request->kategorija,
            'opis' => $request->opis,
            'pismo' => $request->pismo,
            'godina' => $request->godina,
            'strana' => $request->strana,
            'izdavac_id' => $request->izdavac['izdavac_id'],
            'cena' => $request->cena,
        ]);

        $autorIds = array_column($request->autori, 'autor_id');
        $knjiga->autori()->attach($autorIds);

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
            'isbn' => 'string|unique:knjiga,isbn,' . $id . ',knjiga_id',
            'naziv' => 'string',
            'kategorija' => 'string',
            'opis' => 'string|unique:knjiga,opis,' . $id . ',knjiga_id',
            'pismo' => 'string',
            'godina' => 'integer|digits:4',
            'strana' => 'integer',
            'cena' => 'numeric',
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
        ]);

        //if ($request->has('autor')) {
        //    $knjiga->autori()->sync($request->autor);
        //}

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
                'detalji' => 'Nije pronađena knjiga sa ID-jem ' . $knjiga_id,
            ], 404);
        }

        if ($request->hasFile('pdf_fajl')) {
            $pdfFile = $request->file('pdf_fajl');

            if ($pdfFile->isValid()) {
                $knjiga->dodajPDF($pdfFile);

                return response()->json([
                    'status' => 'Uspeh',
                    'poruka' => 'PDF fajl uspešno dodat',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Neuspeh',
                    'poruka' => 'Greška prilikom validacije PDF fajla',
                    'detalji' => 'PDF fajl nije validan',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Greska prilikom dodavanja PDF fajla',
                'detalji' => 'PDF fajl nije priložen u zahtevu',
            ], 400);
        }
    }

    // api ruta -> preuzmi pdf knjige
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

    //api ruta -> vrati broj knjiga po kategoriji
    public function vratiBrojKnjigaPoKategoriji()
    {
        $brKnjigaPoKategoriji = Knjiga::select('kategorija', DB::raw('count(*) as broj_knjiga'))
            ->groupBy('kategorija')
            ->get();

        return response()->json([
            $brKnjigaPoKategoriji
        ], 200);
    }

    //api ruta -> vrati broj kupljenih knjiga po kategoriji
    public function vratiBrojKupljenihKnjigaPoKategoriji()
    {
        $brKupljenihKnjigaPoKategoriji = DB::table('korisnik_knjiga')
            ->join('knjiga', 'korisnik_knjiga.knjiga_id', '=', 'knjiga.knjiga_id')
            ->select('knjiga.kategorija', DB::raw('count(*) as broj_knjiga'))
            ->groupBy('knjiga.kategorija')
            ->get();

        return response()->json([
            $brKupljenihKnjigaPoKategoriji
        ], 200);
    }

    //api ruta -> vrati prodaju knjiga tokom vremena
    public function vratiProdajuKnjigaTokomVremena()
    {
        $prodajaPoMesecima = DB::table('korisnik_knjiga')
            ->select(DB::raw('MONTH(created_at) as mesec'), DB::raw('COUNT(*) as broj_prodatih_knjiga'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json([
            'prodaja_po_mesecima' => $prodajaPoMesecima,
        ], 200);
    }
}
