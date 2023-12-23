<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stadion extends Model
{
    use HasFactory;

    protected $table = 'stadion';
    protected $primarniKljuc = 'stadionId';
    protected $fillable = [
        'naziv',
        'adresa',
    ];
    public $timestamps = true;

    public function utakmice(): HasMany
    {
        return $this->hasMany(Utakmica::class, 'stadionId');
    }
}
