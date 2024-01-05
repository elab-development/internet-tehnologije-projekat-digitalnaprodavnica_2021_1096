<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class StavkaKorpe extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'stavka_korpe';
    protected $primaryKey = 'stavka_korpe_id';
    protected $fillable = ['korpa_id', 'knjiga_id', 'kolicina'];

    public function korpa(): BelongsTo
    {
        return $this->belongsTo(Korpa::class, 'korpa_id');
    }

    public function knjiga(): BelongsTo
    {
        return $this->belongsTo(Knjiga::class, 'knjiga_id');
    }
}
