<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Korisnik extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'korisnik';
    protected $primaryKey = 'korisnik_id';
    protected $fillable = [
        'email',
        'password',
        'username',
        'ime',
        'prezime',
        'reset_password_token',
        'profilna_slika',
    ];
    protected $guarded = 'isAdmin';
    public $timestamps = true;

    public function korpa(): HasOne
    {
        return $this->hasOne(Korpa::class, 'korisnik_id');
    }
}
