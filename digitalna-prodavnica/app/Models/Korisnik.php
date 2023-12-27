<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Korisnik extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'korisnik';
    protected $primaryKey = 'korisnikId';
    protected $fillable = [
        'email',
        'password',
        'ime',
        'prezime',
    ];
    protected $guarded = 'isAdmin';
    public $timestamps = true;

    public function karte(): BelongsToMany
    {
        return $this->belongsToMany(Karta::class, 'karta_korisnik')->withPivot('kolicina');
    }
}
