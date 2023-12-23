<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function utakmica(): BelongsTo
    {
        return $this->belongsTo(Utakmica::class, 'utakmicaId');
    }
}
