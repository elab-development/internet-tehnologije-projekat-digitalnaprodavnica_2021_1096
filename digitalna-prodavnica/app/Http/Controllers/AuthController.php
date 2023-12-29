<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $podaci = $request->validate([
            'email' => 'required|email|unique:korisnik,email',
            'password' => 'required|string',
            'username' => 'required|string|unique:korisnik,username',
            'ime' => 'required|string',
            'prezime' => 'required|string',
        ]);

        $korisnik = Korisnik::create([
            'email' => $podaci['email'],
            'password' => $podaci['password'],
            'username' => $podaci['username'],
            'ime' => $podaci['ime'],
            'prezime' => $podaci['prezime'],
        ]);

        $token = $korisnik->createToken('token')->plainTextToken;

        return response()->json([
            'korisnik' => $korisnik,
            'token' => $token,
        ], 200);
    }

    public function login(Request $request)
    {
        $podaci = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $korisnik = Korisnik::where('email', $podaci['email'])->first();
        if (!$korisnik || $podaci['password'] !== $korisnik->password) {
            return response()->json(['poruka' => 'Neuspesno logovanje'], 403);
        }

        $token = $korisnik->createToken('token')->plainTextToken;

        return response()->json([
            'korisnik' => $korisnik,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['poruka' => 'Korisnik izlogovan'], 200);
    }

    public function zaboravljenaLozinka(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $korisnik = Korisnik::where('email', $request->email)->first();

        if (!$korisnik) {
            return response()->json(['poruka' => 'Korisnik sa ovim email-om ne postoji'], 404);
        }

        $token = Str::random(60);
        $korisnik->update(['reset_password_token' => $token]);

        $link = url("/promena-lozinke/$token");

        Mail::raw("Link za promenu lozinke: $link", function ($mail) use ($korisnik) {
            $mail->to($korisnik->email)->subject('Promena lozinke');
        });

        return response()->json(['poruka' => 'Link za promenu lozinke poslat na email: ' . $korisnik->email], 200);
    }

    public function promeniLozinku(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $korisnik = Korisnik::where('reset_password_token', $token)->first();

        if (!$korisnik) {
            return response()->json(['poruka' => 'Neispravan token'], 404);
        }

        $korisnik->update([
            'password' => $request->password,
            'reset_password_token' => null,
        ]);

        return response()->json(['poruka' => 'Lozinka uspesno promenjena']);
    }
}
