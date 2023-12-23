<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karta extends Model
{
    use HasFactory;

    protected $table = 'karta';
    protected $primarniKljuc = 'kartaId';

    public function utakmica(): HasOne
    {
        return $this->hasOne(Utakmica::class);
    }

    protected $fillable = [
        'brojKarte',
        'cena',
        'kolicina',
    ];

    public $timestamps = true;
}
