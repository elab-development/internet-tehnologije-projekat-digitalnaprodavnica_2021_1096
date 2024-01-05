<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Knjiga extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'knjiga';
    protected $primaryKey = 'knjiga_id';
    protected $fillable = [
        'isbn',
        'naziv',
        'kategorija',
        'opis',
        'pismo',
        'godina',
        'strana',
        'cena',
        'izdavac_id',
        'pdf_path',
    ];
    public $timestamps = true;

    public function autori(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'knjiga_autor', 'knjiga_id', 'autor_id');
    }

    public function izdavac(): BelongsTo
    {
        return $this->belongsTo(Izdavac::class, 'knjiga_id');
    }

    public function dodajPDF($pdf)
    {
        $nazivFajla = $this->naziv . '.pdf';
        $pdf->storeAs('pdfs', $nazivFajla);
        $this->pdf_path = 'pdfs/' . $nazivFajla;
        $this->save();
    }
}
