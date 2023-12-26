<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KartaController;
use App\Http\Controllers\KorisnikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// resource ruta
Route::middleware('auth:sanctum')->resource('karte', KartaController::class);

// razliciti tipovi ruta; osnovni, wildcard
Route::get('/karte', [KartaController::class, 'index']);
Route::get('/karte/{brojKarte}', [KartaController::class, 'show']);
Route::get('/korisnici', [KorisnikController::class, 'index']);
Route::get('/korisnici/{id}', [KorisnikController::class, 'show']);

// api rute
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
