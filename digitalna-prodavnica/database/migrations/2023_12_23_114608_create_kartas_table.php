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
        Schema::create('karta', function (Blueprint $table) {
            $table->id('kartaId');
            $table->string('brojKarte')->unique();
            $table->unsignedDecimal('cena');
            $table->unsignedInteger('kolicina');
            $table->unsignedBigInteger('utakmicaId');
            $table->foreign('utakmicaId')
                ->references('utakmicaId')
                ->on('utakmica')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karta');
    }
};
