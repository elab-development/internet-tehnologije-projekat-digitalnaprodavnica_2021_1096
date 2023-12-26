<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KartaController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Support\Facades\Route;


Route::get('/karte', [KartaController::class, 'index']);
Route::get('/karte/{brojKarte}', [KartaController::class, 'show']);
Route::get('/korisnici', [KorisnikController::class, 'index']);
Route::get('/korisnici/{id}', [KorisnikController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
//