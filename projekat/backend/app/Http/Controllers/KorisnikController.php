<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KorisnikController extends Controller
{

    // api ruta -> vraca sve korisnike
    public function index()
    {
        $korisnici = Korisnik::paginate();

        if (!$korisnici) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoje korisnici u sistemu',
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'korisnici' => $korisnici->items(),
        ], 200);
    }

    // api ruta -> vraca konkretnog korisnika
    public function show($username)
    {
        $korisnik = Cache::remember('korisnik_' . $username, 60 * 24, function ()  use ($username) {
            return Korisnik::where('username', $username)->first();
        });

        if (!$korisnik) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoji korisnik: ' . $username
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'korisnik' => $korisnik
        ], 200);
    }

    // api ruta -> kreira jednog korisnika
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:korisnik,email',
            'password' => 'required|string',
            'username' => 'required|string|unique:korisnik,username',
            'ime' => 'required|string',
            'prezime' => 'required|string',
        ]);

        $korisnik = Korisnik::create([
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'ime' => $request->ime,
            'prezime' => $request->prezime,
        ]);

        return response()->json([
            'status' => 'Uspeh',
        ]);
    }

    // api ruta -> menja podatke o konkretnom korisniku
    public function update(Request $request, $id)
    {
        $korisnik = Korisnik::where('korisnik_id', $id)->first();

        if (!$korisnik) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'korisnik ne postoji',
            ], 404);
        }

        $request->validate([
            'email' => 'email|unique:korisnik,email',
            'password' => 'string',
            'username' => 'string|unique:korisnik,username',
            'ime' => 'string',
            'prezime' => 'string',
        ]);

        $korisnik->update([
            'email' => $request->email === null ? $korisnik->email : $request->email,
            'password' => $request->password === null ? $korisnik->password : $request->password,
            'username' => $request->username === null ? $korisnik->username : $request->username,
            'ime' => $request->ime === null ? $korisnik->ime : $request->ime,
            'prezime' => $request->prezime === null ? $korisnik->prezime : $request->prezime,
        ]);

        return response()->json([
            'status' => 'Uspeh',
        ], 200);
    }

    // api ruta -> brise konkretnog korisnika
    public function destroy($id)
    {
        $korisnik = Korisnik::where('korisnik_id', $id)->first();

        if (!$korisnik) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Korisnik ne postoji',
            ], 404);
        }

        $korisnik->delete();

        return response()->json([
            'status' => 'Uspeh',
        ], 200);
    }

    // api ruta -> dodaje profilnu konkretnom korisniku
    public function dodajProfilnu(Request $request, $korisnik_id)
    {
        $request->validate([
            'profilna_slika' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $korisnik = Korisnik::where('korisnik_id', $korisnik_id)->first();

        if (!$korisnik) {
            return response()->json(['poruka' => 'Korisnik ne postoji'], 404);
        }

        if ($request->hasFile('profilna_slika') && $request->file('profilna_slika')->isValid()) {
            $nazivSlike = $korisnik_id . '-profilna-slika.' . $request->profilna_slika->extension();

            $request->profilna_slika->storeAs('profilne', $nazivSlike);

            $korisnik->update([
                'profilna_slika' => 'profilne/' . $nazivSlike,
            ]);
            return response()->json([
                'status' => 'Uspeh',
                'poruka' => 'Profilna slika promenjena'
            ], 201);
        }

        return response()->json([
            'status' => 'Neuspeh',
            'poruka' => 'Greska prilikom menjanja slike'
        ], 400);
    }

    public function vratiKorisnika($korisnik_id)
    {
        $korisnik = Korisnik::where('korisnik_id', $korisnik_id)->first();

        if (!$korisnik) {
            return response()->json([
                'status' => 'Neuspeh',
                'poruka' => 'Ne postoji korisnik:'
            ], 404);
        }

        return response()->json([
            'status' => 'Uspeh',
            'korisnik' => $korisnik
        ], 200);
    }
}
