<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Autor extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'autor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ime',
        'prezime',
        'datum_rodjenja',
        'mesto_rodjenja',
        'biografija'
    ];
    public $timestamps = true;

    public function knjige()
    {
        return $this->hasMany(Knjiga::class);
    }
}
