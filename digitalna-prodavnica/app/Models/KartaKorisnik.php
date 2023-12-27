<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartaKorisnik extends Model
{
    use HasFactory;

    protected $table = 'karta_korisnik';
    protected $fillable = [
        'kartaId',
        'korisnikId',
        'kolicina',
    ];
}
