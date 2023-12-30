<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Izdavac extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'izdavac';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naziv',
        'adresa',
    ];
    public $timestamps = true;

    public function knjige()
    {
        return $this->belongsToMany(Knjiga::class, 'knjiga_autor', 'autor_id', 'knjiga_id');
    }
}
