<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Utakmica extends Model
{
    use HasFactory;

    protected $table = 'utakmica';
    protected $primarniKljuc = 'utakmicaId';

    public function stadion(): HasOne
    {
        return $this->hasOne(Stadion::class);
    }

    protected $fillable = [
        'timDomacin',
        'timGost',
        'tipSporta',
        'datumVreme',
    ];

    public $timestamps = true;
}
