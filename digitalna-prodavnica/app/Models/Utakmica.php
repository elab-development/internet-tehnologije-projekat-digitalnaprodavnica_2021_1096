<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Utakmica extends Model
{
    use HasFactory;

    protected $table = 'utakmica';
    protected $primarniKljuc = 'utakmicaId';
    protected $fillable = [
        'timDomacin',
        'timGost',
        'tipSporta',
        'datumVreme',
        'stadionId',
    ];
    public $timestamps = true;

    public function stadion(): BelongsTo
    {
        return $this->belongsTo(Stadion::class, 'stadionId');
    }
}
