<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karta extends Model
{
    use HasFactory;

    protected $table = 'karta';
    protected $primaryKey = 'kartaId';
    protected $fillable = [
        'brojKarte',
        'cena',
        'kolicina',
        'utakmicaId',
    ];
    public $timestamps = true;

    public function korisnici(): BelongsToMany
    {
        return $this->belongsToMany(Korisnik::class, 'karta_korisnik', 'kartaId', 'korisnikId')
            ->withPivot('kolicina');
    }

    public function utakmica(): BelongsTo
    {
        return $this->belongsTo(Utakmica::class, 'utakmicaId');
    }
}
