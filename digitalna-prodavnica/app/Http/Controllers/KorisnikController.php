<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Http\Requests\StoreKorisnikRequest;
use App\Http\Requests\UpdateKorisnikRequest;
use App\Models\Korpa;
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
            'poruka' => 'Korisnik kreiran',
            'korisnik' => $korisnik,
        ]);
    }

    public function update(Request $request, $id)
    {
        $korisnik = Korisnik::where('korisnik_id', $id)->first();

        if (!$korisnik) {
            return response()->json([
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
            'poruka' => 'Uspesna izmena',
            'korisnik' => $korisnik,
        ], 200);
    }

    public function destroy($id)
    {
        $korisnik = Korisnik::where('korisnik_id', $id)->first();

        if (!$korisnik) {
            return response()->json([
                'poruka' => 'Korisnik ne postoji',
            ], 404);
        }

        $korisnik->delete();

        return response()->json([
            'poruka' => 'Uspesno brisanje',
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

    public function vratiKorpuKorisnika($id)
    {
        $korisnik = Korisnik::where('korisnik_id', $id)->first();

        if (!$korisnik) {
            return response()->json([
                'poruka' => 'Korisnik ne postoji',
            ], 404);
        }

        return response()->json([
            'korpa' => $korisnik->korpa()->first(),
        ], 200);
    }
}
