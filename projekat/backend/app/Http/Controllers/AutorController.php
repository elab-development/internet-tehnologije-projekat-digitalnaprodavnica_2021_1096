<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // api ruta -> vraca sve autore
    public function index()
    {
        $autori = Autor::paginate();

        if (!$autori) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoje autori u sistemu'
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'autori' => $autori->items(),
        ], 200);
    }

    // api ruta -> kreira autora
    public function store(Request $request)
    {
        $request->validate([
            'ime' => 'required|string',
            'prezime' => 'required|string',
            'datum_rodjenja' => 'required|date',
            'mesto_rodjenja' => 'required|string',
            'biografija' => 'required|string',
        ]);

        $autor = Autor::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'datum_rodjenja' => $request->datum_rodjenja,
            'mesto_rodjenja' => $request->mesto_rodjenja,
            'biografija' => $request->biografija,
        ]);

        return response()->json([
            'status' => 'Uspeh',
            'autor' => $autor,
        ], 201);
    }

    // api ruta -> prikazuje konkretnog autora
    public function show($id)
    {
        $autor = Autor::where('autor_id', $id)->first();
        if (!$autor) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'autor' => $autor,
        ], 200);
    }

    // api ruta -> menja podatke o konkretnom autoru
    public function update(Request $request, $id)
    {
        $autor = Autor::where('autor_id', $id)->first();

        if (!$autor) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        $request->validate([
            'ime' => 'string',
            'prezime' => 'string',
            'datum_rodjenja' => 'date',
            'mesto_rodjenja' => 'string',
            'biografija' => 'string',
        ]);

        $autor->update([
            'ime' => $request->ime === null ? $autor->ime : $request->ime,
            'prezime' => $request->prezime === null ? $autor->prezime : $request->prezime,
            'datum_rodjenja' => $request->datum_rodjenja === null ? $autor->datum_rodjenja : $request->datum_rodjenja,
            'mesto_rodjenja' => $request->mesto_rodjenja === null ? $autor->mesto_rodjenja : $request->mesto_rodjenja,
            'biografija' => $request->biografija === null ? $autor->biografija : $request->biografija,
        ]);

        return response()->json([
            'status' => 'Uspeh',
            'autor' => $autor,
        ], 200);
    }

    // api ruta -> brise konkretnog autora
    public function destroy($id)
    {
        $autor = Autor::where('autor_id', $id)->first();

        if (!$autor) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        $autor->delete();

        return response()->json([
            'status' => 'Uspeh',
        ], 200);
    }

    // api ruta -> vraca knjige od konkretnog autora
    public function vratiKnjigeAutora($autor_id)
    {
        $autor = Autor::with('knjige')->where('autor_id', $autor_id)->first();

        if (!$autor) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'autor' => $autor,
        ], 200);
    }
}
