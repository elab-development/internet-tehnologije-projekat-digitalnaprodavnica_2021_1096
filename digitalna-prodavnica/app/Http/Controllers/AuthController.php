<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $podaci = $request->validate([
            'email' => 'required|string|unique:korisnik,email',
            'password' => 'required|string',
            'ime' => 'required|string',
            'prezime' => 'required|string',
        ]);

        $korisnik = Korisnik::create([
            'email' => $podaci['email'],
            'password' => $podaci['password'],
            'ime' => $podaci['ime'],
            'prezime' => $podaci['prezime'],
        ]);

        $token = $korisnik->createToken('token')->plainTextToken;

        $response = [
            'korisnik' => $korisnik,
            'token' => $token,
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $podaci = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $korisnik = Korisnik::where('email', $podaci['email'])->first();
        if (!$korisnik || $podaci['password'] !== $korisnik->password) {
            return response()->json(['poruka' => 'Neuspesno logovanje'], 401);
        }

        $token = $korisnik->createToken('token')->plainTextToken;

        $response = [
            'korisnik' => $korisnik,
            'token' => $token,
        ];

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['poruka' => 'Korisnik izlogovan'], 200);
    }
}
