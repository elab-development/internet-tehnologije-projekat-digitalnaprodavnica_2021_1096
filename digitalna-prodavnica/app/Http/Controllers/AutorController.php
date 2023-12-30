<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // vrati sve Autore
    public function index()
    {
        $autori = Autor::paginate();

        if (!$autori) {
            return response()->json([
                'poruka' => 'Ne postoje autori u sistemu'
            ], 404);
        }

        return response()->json([
            'autori' => $autori,
        ], 200);
    }

    // kreiraj jednog Autora
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
            'autor' => $autor,
        ], 201);
    }

    // prikazi jednog Autora
    public function show($id)
    {
        $autor = Autor::where('id', $id)->first();
        if (!$autor) {
            return response()->json([
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        return response()->json([
            'autor' => $autor,
        ], 200);
    }

    // promeni jednog Autora
    public function update(Request $request, $id)
    {
        $autor = Autor::where('id', $id)->first();

        if (!$autor) {
            return response()->json([
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
            'poruka' => 'Uspesna izmena',
            'autor' => $autor,
        ], 200);
    }

    // brisanje autora
    public function destroy($id)
    {
        $autor = Autor::where('id', $id)->first();

        if (!$autor) {
            return response()->json([
                'poruka' => 'Autor ne postoji',
            ], 404);
        }

        $autor->delete();

        return response()->json([
            'poruka' => 'Uspesno brisanje',
        ], 200);
    }
}
