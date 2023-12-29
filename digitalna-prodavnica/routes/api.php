<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KartaController;
use App\Http\Controllers\KartaKorisnikController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Support\Facades\Route;

// api rute za prikaz svih karata, jedne karte i svih karata u kategoriji sporta
Route::get('/karte', [KartaController::class, 'index']);
Route::get('/karte/{brojKarte}', [KartaController::class, 'show']);
Route::get('/karte/kategorija/{tipSporta}', [KartaController::class, 'vratiKartePoSportu']);

// api rute za login, register, zaboravljenu lozinku i promenu lozinke
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/zaboravljena-lozinka', [AuthController::class, 'zaboravljenaLozinka']);
Route::post('/auth/promena-lozinke/{token}', [AuthController::class, 'promeniLozinku']);

// api rute -> samo ulogovani korisnici
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/{username}', [KorisnikController::class, 'show']);
    Route::post('/{username}/dodaj-profilnu-sliku', [KorisnikController::class, 'dodajProfilnu']);
    Route::post('/{username}/dodaj-kartu/{brojKarte}', [KartaKorisnikController::class, 'kupiKartu']);
    Route::get('/{username}/karte', [KartaKorisnikController::class, 'vratiSveKarte']);
    Route::get('/{username}/karte/{brojKarte}', [KartaKorisnikController::class, 'vratiKartu']);
    Route::post('/{username}/promena-podataka', [KorisnikController::class, 'promeniPodatke']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// api ruta za prikaz svih korisnika -> samo admin korisnici
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/korisnici/svi', [KorisnikController::class, 'index']);
});
