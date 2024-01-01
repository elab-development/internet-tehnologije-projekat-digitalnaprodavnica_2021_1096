<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\IzdavacController;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\KorpaController;
use App\Http\Controllers\StavkaKorpeController;
use Illuminate\Support\Facades\Route;

// api rute -> login, register, zaboravljenu lozinku i promenu lozinke
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/zaboravljena-lozinka', [AuthController::class, 'zaboravljenaLozinka']);
Route::post('/auth/promena-lozinke/{token}', [AuthController::class, 'promeniLozinku']);

// api rute -> samo ulogovani korisnici
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/{username}/profil', [KorisnikController::class, 'show']);
    Route::get('/korisnici', [KorisnikController::class, 'index']);
    Route::put('/korisnici/{korisnik_id}', [KorisnikController::class, 'update']);
    Route::delete('/korisnici/{korisnik_id}', [KorisnikController::class, 'destroy']);

    Route::post('/{username}/dodaj-profilnu-sliku', [KorisnikController::class, 'dodajProfilnu']);

    Route::get('/{korisnik_id}/korpa', [KorpaController::class, 'index']);
    Route::post('/{korisnik_id}/korpa', [StavkaKorpeController::class, 'store']);
    Route::delete('/{korisnik_id}/korpa/{stavka_id}', [StavkaKorpeController::class, 'destroy']); //todo
    Route::delete('/{korisnik_id}/korpa', [KorpaController::class, 'destroy']); //todo

    Route::post('/knjige', [KnjigaController::class, 'store']);
    Route::put('/knjige/{knjiga_id}', [KnjigaController::class, 'update']);
    Route::delete('/knjige/{knjiga_id}', [KnjigaController::class, 'destroy']);

    Route::post('/knjiga/{knjiga_id}/dodaj-pdf', [KnjigaController::class, 'dodajPDF']);
    Route::get('/knjiga/{knjiga_id}/preuzmi-pdf', [KnjigaController::class, 'preuzmiPDF']);

    Route::post('/autori', [AutorController::class, 'store']);
    Route::put('/autori/{autor_id}', [AutorController::class, 'update']);
    Route::delete('/autori/{autor_id}', [AutorController::class, 'destroy']);

    Route::post('/izdavaci', [IzdavacController::class, 'store']);
    Route::put('/izdavaci/{izdavac_id}', [IzdavacController::class, 'update']);
    Route::delete('/izdavaci/{izdavac_id}', [IzdavacController::class, 'destroy']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// todo -> placanje w/ PayPal_Rest
Route::post('/plati', [KorpaController::class, 'plati']);

// api rute -> knjige
Route::get('/knjige', [KnjigaController::class, 'index']);
Route::get('/knjige/{knjiga_id}', [KnjigaController::class, 'show']);
Route::get('/knjige/kategorija/{kategorija}', [KnjigaController::class, 'vratiKnjigeUKategoriji']);

// api rute -> autori
Route::get('/autori', [AutorController::class, 'index']);
Route::get('/autori/{autor_id}', [AutorController::class, 'show']);

// api rute -> izdavaci
Route::get('/izdavaci', [IzdavacController::class, 'index']);
Route::get('/izdavaci/{izdavac_id}', [IzdavacController::class, 'show']);

// api rute -> prikaz knjiga od autorima i izdavaca
Route::get('/knjige/autor/{autor_id}', [AutorController::class, 'vratiKnjigeAutora']);
Route::get('/knjige/izdavac/{izdavac_id}', [IzdavacController::class, 'vratiKnjigeIzdavaca']); 

// todo -> testiranje ruta