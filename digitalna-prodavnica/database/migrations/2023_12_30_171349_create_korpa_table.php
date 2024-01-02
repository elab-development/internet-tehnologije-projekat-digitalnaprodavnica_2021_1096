<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('korpa', function (Blueprint $table) {
            $table->id('korpa_id');
            $table->unsignedBigInteger('korisnik_id');
            $table->timestamps();
        });

        Schema::create('stavka_korpe', function (Blueprint $table) {
            $table->id('stavka_korpe_id');
            $table->unsignedBigInteger('korpa_id');
            $table->unsignedBigInteger('knjiga_id');
            $table->integer('kolicina');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stavka_korpe');
        Schema::dropIfExists('korpa');
    }
};
