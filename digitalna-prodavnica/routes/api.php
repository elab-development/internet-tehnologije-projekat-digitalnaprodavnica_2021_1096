<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KartaController;
use App\Http\Controllers\KartaKorisnikController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Support\Facades\Route;

Route::get('/karte', [KartaController::class, 'index']);
Route::get('/karte/{brojKarte}', [KartaController::class, 'show']);
Route::get('/karte/kategorija/{tipSporta}', [KartaController::class, 'vratiKartePoSportu']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/korisnici/{korisnikId}/dodaj-kartu/{brojKarte}', [KartaKorisnikController::class, 'kupiKartu']);
    Route::get('/korisnici/{korisnikId}/karte', [KartaKorisnikController::class, 'vratiSveKarte']);
    Route::get('/korisnici/{korisnikId}/karte/{brojKarte}', [KartaKorisnikController::class, 'vratiKartu']);
    Route::get('/korisnici', [KorisnikController::class, 'index']);
    Route::get('/korisnici/{korisnikId}', [KorisnikController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
