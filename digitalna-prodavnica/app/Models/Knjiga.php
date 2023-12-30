<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Knjiga extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'knjiga';
    protected $primaryKey = 'id';
    protected $fillable = [
        'isbn',
        'naziv',
        'autor',
        'izdavac',
        'kategorija',
        'opis',
        'pismo',
        'godina',
        'strana',
        'autor_id',
        'izdavac_id',
    ];
    public $timestamps = true;

    public function autori()
    {
        return $this->belongsToMany(Autor::class, 'knjiga_autor', 'knjiga_id', 'autor_id');
    }

    public function izdavac()
    {
        return $this->belongsTo(Izdavac::class);
    }
}
