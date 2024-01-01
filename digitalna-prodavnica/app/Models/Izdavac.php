<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Izdavac extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'izdavac';
    protected $primaryKey = 'izdavac_id';
    protected $fillable = [
        'naziv',
        'adresa',
    ];
    public $timestamps = true;

    public function knjige(): HasMany
    {
        return $this->hasMany(Knjiga::class, 'izdavac_id');
    }
}
