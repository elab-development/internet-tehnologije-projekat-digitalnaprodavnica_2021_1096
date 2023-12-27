<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karta_korisnik', function (Blueprint $table) {
            $table->unsignedBigInteger('kartaId');
            $table->unsignedBigInteger('korisnikId');
            $table->unsignedInteger('kolicina');
            $table->timestamps();

            $table->foreign('kartaId')->references('kartaId')->on('karta')->onDelete('cascade');
            $table->foreign('korisnikId')->references('korisnikId')->on('korisnik')->onDelete('cascade');

            $table->primary(['kartaId', 'korisnikId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karta_korisnik');
    }
};
