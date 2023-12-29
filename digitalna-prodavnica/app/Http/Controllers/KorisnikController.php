<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Http\Requests\StoreKorisnikRequest;
use App\Http\Requests\UpdateKorisnikRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KorisnikController extends Controller
{

    public function index()
    {
        $korisnici = Korisnik::paginate();

        if (!$korisnici) {
            return response()->json(['poruka' => 'Ne postoje korisnici u sistemu'], 404);
        }

        return response()->json([
            'korisnici' => $korisnici
        ], 200);
    }


    public function show($username)
    {
        $korisnik = Cache::remember('korisnik_' . $username, 60 * 24, function ()  use ($username) {
            return Korisnik::where('username', $username)->first();
        });

        if (!$korisnik) {
            return response()->json(['poruka' => 'Ne postoji korisnik: ' . $username], 404);
        }

        return response()->json([
            'korisnik' => $korisnik
        ], 200);
    }

    public function promeniPodatke(Request $request, $username)
    {
        $korisnik = Korisnik::where('username', $username)->first();
        if (!$korisnik) {
            return response()->json(['poruka' => 'Ne postoji korisnik: ' . $username], 404);
        }

        $request->validate([
            'email' => 'email|unique:korisnik,email',
            'password' => 'string',
            'username' => 'string|unique:korisnik,username',
            'ime' => 'string',
            'prezime' => 'string',
        ]);

        if ($request->email && $korisnik->email !== $request->email) {
            $korisnik->update([
                'email' => $request->email
            ]);
        }
        if ($request->password && $korisnik->password !== $request->password) {
            $korisnik->update([
                'password' => $request->password
            ]);
        }
        if ($request->username && $korisnik->username !== $request->username) {
            $korisnik->update([
                'username' => $request->username
            ]);
        }
        if ($request->ime && $korisnik->ime !== $request->ime) {
            $korisnik->update([
                'ime' => $request->ime
            ]);
        }
        if ($request->prezime && $korisnik->prezime !== $request->prezime) {
            $korisnik->update([
                'prezime' => $request->prezime
            ]);
        }

        return response()->json([
            'poruka' => 'Uspesno izmenjeni podaci',
            'korisnik' => $korisnik,
        ], 200);
    }

    public function dodajProfilnu(Request $request, $username)
    {
        $request->validate([
            'profilna_slika' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $korisnik = Korisnik::where('username', $username)->first();

        if (!$korisnik) {
            return response()->json(['poruka' => 'Korisnik ne postoji'], 404);
        }

        if ($request->hasFile('profilna_slika') && $request->file('profilna_slika')->isValid()) {
            $nazivSlike = $username . '-profilna.' . $request->profilna_slika->extension();

            $request->profilna_slika->storeAs('profilne', $nazivSlike);

            $korisnik->update([
                'profilna_slika' => 'profilne/' . $nazivSlike,
            ]);
            return response()->json(['poruka' => 'Profilna slika promenjena'], 201);
        }

        return response()->json(['poruka' => 'Greska prilikom menjanja slike'], 400);
    }
}
