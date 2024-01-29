<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\IzdavacController;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\KorpaController;
use App\Http\Controllers\PlacanjeController;
use App\Http\Controllers\StavkaKorpeController;
use Illuminate\Support\Facades\Route;

// api rute -> login, register, zaboravljenu lozinku i promenu lozinke
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/zaboravljena-lozinka', [AuthController::class, 'zaboravljenaLozinka']);
Route::post('/auth/promena-lozinke/{token}', [AuthController::class, 'promeniLozinku']);

// api rute -> knjige
Route::get('/knjige', [KnjigaController::class, 'index']);
Route::get('/knjige/{knjiga_id}', [KnjigaController::class, 'show']);
Route::get('/knjige/kategorija/{kategorija}', [KnjigaController::class, 'vratiKnjigeUKategoriji']);

// api ruta -> vraca sve kupljene knjige
Route::get('/{korisnik_id}/moje-knjige', [KorisnikController::class, 'vratiKupljeneKnjige']);

// api rute -> prikaz knjiga od autora i izdavaca
Route::get('/knjige/autor/{autor_id}', [AutorController::class, 'vratiKnjigeAutora']);
Route::get('/knjige/izdavac/{izdavac_id}', [IzdavacController::class, 'vratiKnjigeIzdavaca']);

// api rute -> vizuelizacija na frontendu
Route::get('/broj-knjiga-po-kategoriji', [KnjigaController::class, 'vratiBrojKnjigaPoKategoriji']);
Route::get('/broj-kupljenih-knjiga-po-kategoriji', [KnjigaController::class, 'vratiBrojKupljenihKnjigaPoKategoriji']);
Route::get('/prodaja-tokom-vremena', [KnjigaController::class, 'vratiProdajuKnjigaTokomVremena']);

// api rute -> samo autentifikovani korisnici
Route::middleware('auth:sanctum')->group(function () {

    // api rute -> crud za korisnike
    Route::post('/korisnici', [KorisnikController::class, 'store']);
    Route::get('/korisnici/{korisnik_id}', [KorisnikController::class, 'show']);
    Route::get('/korisnici', [KorisnikController::class, 'index']);
    Route::put('/korisnici/{korisnik_id}', [KorisnikController::class, 'update']);
    Route::delete('/korisnici/{korisnik_id}', [KorisnikController::class, 'destroy']);

    // api ruta -> dodavanje profilne slike
    Route::post('/{korisnik_id}/dodaj-profilnu-sliku', [KorisnikController::class, 'dodajProfilnu']);
    Route::get('/{korisnik_id}/vrati-profilnu-sliku', [KorisnikController::class, 'vratiProfilnu']);

    // api rute -> crud za korpu
    Route::get('/{korisnik_id}/korpa', [KorpaController::class, 'index']);
    Route::post('/{korisnik_id}/korpa', [StavkaKorpeController::class, 'store']);
    Route::delete('/{korisnik_id}/korpa/{redni_broj_stavke}', [StavkaKorpeController::class, 'destroy']);
    Route::delete('/{korisnik_id}/korpa', [KorpaController::class, 'destroy']);

    // api rute -> crud za knjige
    Route::post('/knjige', [KnjigaController::class, 'store']);
    Route::put('/knjige/{knjiga_id}', [KnjigaController::class, 'update']);
    Route::delete('/knjige/{knjiga_id}', [KnjigaController::class, 'destroy']);

    // api rute -> placanje koriscenjem Stripe API
    Route::post('/{korisnik_id}/placanje', [PlacanjeController::class, 'placanje']);
    Route::post('/{korisnik_id}/success', [PlacanjeController::class, 'success']);
    Route::post('/{korisnik_id}/cancel', [PlacanjeController::class, 'cancel']);

    // api rute -> vracanje knjiga u pdf formatu
    Route::post('/knjiga/{knjiga_id}/dodaj-pdf', [KnjigaController::class, 'dodajPDF']);
    Route::get('/knjiga/{knjiga_id}/preuzmi-pdf', [KnjigaController::class, 'preuzmiPDF']);

    // api rute -> resource rute za autore i izdavace
    Route::resource('autori', AutorController::class);
    Route::resource('izdavaci', IzdavacController::class);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
