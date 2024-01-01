<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Autor extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'autor';
    protected $primaryKey = 'autor_id';
    protected $fillable = [
        'ime',
        'prezime',
        'datum_rodjenja',
        'mesto_rodjenja',
        'biografija'
    ];
    public $timestamps = true;

    public function knjige(): BelongsToMany
    {
        return $this->belongsToMany(Knjiga::class, 'knjiga_autor', 'autor_id', 'knjiga_id');
    }
}
