<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\IzdavacController;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Support\Facades\Route;

// api rute za login, register, zaboravljenu lozinku i promenu lozinke
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/zaboravljena-lozinka', [AuthController::class, 'zaboravljenaLozinka']);
Route::post('/auth/promena-lozinke/{token}', [AuthController::class, 'promeniLozinku']);

// api rute -> samo ulogovani korisnici
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/{username}/profil', [KorisnikController::class, 'show']);
    Route::post('/{username}/dodaj-profilnu-sliku', [KorisnikController::class, 'dodajProfilnu']);
    Route::post('/{username}/promena-podataka', [KorisnikController::class, 'promeniPodatke']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// api ruta za prikaz svih korisnika -> samo admin korisnici
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/korisnici', [KorisnikController::class, 'index']);
    Route::post('/knjige', [KnjigaController::class, 'store']);
    Route::put('/knjige/{knjiga_id}', [KnjigaController::class, 'update']);
    Route::delete('/knjige/{knjiga_id}', [KnjigaController::class, 'destroy']);
    Route::post('/autori', [AutorController::class, 'store']);
    Route::put('/autori/{autor_id}', [AutorController::class, 'update']);
    Route::delete('/autori/{autor_id}', [AutorController::class, 'destroy']);
    Route::post('/izdavaci', [IzdavacController::class, 'store']);
    Route::put('/izdavaci/{izdavac_id}', [IzdavacController::class, 'update']);
    Route::delete('/izdavaci/{izdavac_id}', [IzdavacController::class, 'destroy']);
});

// api rute za knjige
Route::get('/knjige', [KnjigaController::class, 'index']);
Route::get('/knjige/{knjiga_id}', [KnjigaController::class, 'show']);
Route::get('/knjige/kategorija/{kategorija}', [KnjigaController::class, 'vratiKnjigeUKategoriji']);

// api rute za autore
Route::get('/autori', [AutorController::class, 'index']);
Route::get('/autori/{autor_id}', [AutorController::class, 'show']);

// api rute za izdavace
Route::get('/izdavaci', [IzdavacController::class, 'index']);
Route::get('/izdavaci/{izdavac_id}', [IzdavacController::class, 'show']);

// api rute za prikaz knjiga po autorima & po izdavacima
Route::get('/knjige/autor/{autor_id}', [KnjigaController::class, 'vratiKnjigePoAutorima']);
Route::get('/knjige/izdavac/{izdavac_id}', [KnjigaController::class, 'vratiKnjigePoIzdavacima']); 

// todo -> testiranje ruta