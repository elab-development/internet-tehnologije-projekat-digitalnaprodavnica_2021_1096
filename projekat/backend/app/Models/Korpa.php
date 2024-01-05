<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Korpa extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'korpa';
    protected $primaryKey = 'korpa_id';
    protected $fillable = ['korisnik_id'];

    public function korisnik(): BelongsTo
    {
        return $this->belongsTo(Korisnik::class, 'korpa_id');
    }

    public function stavke(): HasMany
    {
        return $this->hasMany(StavkaKorpe::class, 'korpa_id');
    }
}
